<?php

namespace App\Repositories\References;

use App\Exceptions\BusinessException;
use App\Interfaces\References\RefSiswaInterface;
use App\Models\References\RefSiswa;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RefSiswaRepository extends BaseRepository implements RefSiswaInterface
{
    const GENDER_LAKI_LAKI = 1;
    const GENDER_PEREMPUAN = 0;

    const ID_REF_KELAS_XII = 3;
    const STATUS_SISWA_AKTIF = 1;
    const STATUS_SISWA_LULUS = 3;

    public function __construct(
        private RefSiswa $refSiswa
    )
    {
        parent::__construct($refSiswa);
    }

    /**
     * @param int|null $start
     * @param int|null $end
     * @param string|null $search
     * @return mixed
     */
    public function dtSiswa(int $start = null, int $end = null, string $search = null): mixed
    {
        $subQuery = $this->refSiswa
            ->newQuery()
            ->select([
                'uuid',
                'nisn',
                'nomor_induk',
                'nama_lengkap',
                'gender'
            ])
            ->scopes(['aktif'])
            ->selectRaw("ROW_NUMBER() OVER (ORDER BY id asc) AS row_num");

        if ($search !== null) {
            $subQuery->where(function ($query) use ($search) {
                $query->whereRaw("lower(nisn) like ?", ["%".$search."%"])
                    ->orWhereRaw("lower(nomor_induk) like ?", ["%".$search."%"])
                    ->orWhereRaw("lower(nama_lengkap) like ?", ["%".$search."%"]);

                if (str_contains($search, 'laki'))
                {
                    $query->orWhereRaw("gender = ?", [self::GENDER_LAKI_LAKI]);
                }
                if (str_contains($search, 'perempuan'))
                {
                    $query->orWhereRaw("gender = ?", [self::GENDER_PEREMPUAN]);
                }
            });
        }

        $query = DB::query()->fromSub($subQuery, 't');

        if ($start !== null && $end !== null) {
            $query->whereBetween('row_num', [$start, $end]);
        }

        return $query->get();
    }

    /**
     * @param string $uuid
     * @return RefSiswa|mixed|null
     */
    public function findByUUID(string $uuid)
    {
        return $this->refSiswa
            ->newQuery()
            ->with(['status_siswa'])
            ->where('uuid', $uuid)
            ->first();
    }

    /**
     * @param string $uuidTahunAjar
     * @return Collection|mixed
     */
    public function getSiswaTanpaKelas(string $uuidTahunAjar)
    {
        return $this->refSiswa
            ->newQuery()
            ->select([
                'uuid',
                'nomor_induk',
                'nisn',
                'nama_lengkap',
            ])
            ->whereNotIn('ref_siswa.id', function ($query) use ($uuidTahunAjar) {
                $query->select('id_ref_siswa')
                    ->from('trans_penempatan_siswa')
                    ->join('ref_kode_kelas', 'trans_penempatan_siswa.id_ref_kode_kelas', '=', 'ref_kode_kelas.id')
                    ->join('ref_tahun_ajar', 'trans_penempatan_siswa.id_ref_tahun_ajar', '=', 'ref_tahun_ajar.id')
                    ->join('ref_kelas', 'ref_kode_kelas.id_ref_kelas', '=', 'ref_kelas.id')
                    ->where('ref_tahun_ajar.uuid', $uuidTahunAjar)
                    ->where('trans_penempatan_siswa.deleted_at', null);
            })
            ->whereNull('deleted_at')
            ->where('id_ref_status_siswa', 1)
            ->orderBy('nama_lengkap', 'asc')
            ->get();
    }

    public function getSiswaByKelasDanTahunAjar(int $idRefTahunAjar, int $idRefKelas, int $start = null, $end = null, $search = null)
    {
        $subQuery = $this->refSiswa->select([
            'ref_siswa.nisn',
            'ref_siswa.nomor_induk',
            'ref_siswa.nama_lengkap',
            'ref_kelas.kelas',
            'ref_kejuruan.kejuruan',
            'ref_kode_kelas.kode_kelas',
            'ref_tahun_ajar.tahun_ajar',
        ])
        ->selectRaw("ROW_NUMBER() OVER (ORDER BY kejuruan asc, kode_kelas asc, nama_lengkap asc) AS row_num")
        ->join('trans_penempatan_siswa', 'ref_siswa.id', '=', 'trans_penempatan_siswa.id_ref_siswa')
        ->join('ref_kode_kelas', 'trans_penempatan_siswa.id_ref_kode_kelas', '=', 'ref_kode_kelas.id')
        ->join('ref_kelas', 'ref_kode_kelas.id_ref_kelas', '=', 'ref_kelas.id')
        ->join('ref_kejuruan', 'ref_kode_kelas.id_ref_kejuruan', '=', 'ref_kejuruan.id')
        ->join('ref_tahun_ajar', 'trans_penempatan_siswa.id_ref_tahun_ajar', '=', 'ref_tahun_ajar.id')
        ->where('ref_kelas.id', $idRefKelas)
        ->where('ref_tahun_ajar.id', $idRefTahunAjar);

        if ($search !== null) {
            $subQuery->where(function ($query) use ($search) {
                $query->whereRaw("lower(nisn) like ?", ["%".$search."%"])
                    ->orWhereRaw("lower(nomor_induk) like ?", ["%".$search."%"])
                    ->orWhereRaw("lower(nama_lengkap) like ?", ["%".$search."%"]);

                if (str_contains($search, 'laki'))
                {
                    $query->orWhereRaw("gender = ?", [self::GENDER_LAKI_LAKI]);
                }
                if (str_contains($search, 'perempuan'))
                {
                    $query->orWhereRaw("gender = ?", [self::GENDER_PEREMPUAN]);
                }
            });
        }

        $query = DB::query()->fromSub($subQuery, 't');

        if ($start !== null && $end !== null) {
            $query->whereBetween('row_num', [$start, $end]);
        }

        return $query->get();
    }

    /**
     * @param int $idTahunAjar
     * @return Builder|mixed
     */
    public function massUpdateSiswaLulusByTahunAjar(int $idTahunAjar)
    {
        try
        {
            return DB::transaction(function () use ($idTahunAjar) {
                $this->refSiswa
                    ->newQuery()
                    ->join('trans_penempatan_siswa', 'ref_siswa.id', '=', 'trans_penempatan_siswa.id_ref_siswa')
                    ->join('ref_kode_kelas', 'trans_penempatan_siswa.id_ref_kode_kelas', '=', 'ref_kode_kelas.id')
                    ->join('ref_kelas', 'ref_kode_kelas.id_ref_kelas', '=', 'ref_kelas.id')
                    ->join('ref_tahun_ajar', 'trans_penempatan_siswa.id_ref_tahun_ajar', '=', 'ref_tahun_ajar.id')
                    ->where('ref_tahun_ajar.id', $idTahunAjar)
                    ->where('ref_kelas.id', self::ID_REF_KELAS_XII)
                    ->where('ref_siswa.id_ref_status_siswa', self::STATUS_SISWA_AKTIF)
                    ->update([
                        'ref_siswa.id_ref_status_siswa' => self::STATUS_SISWA_LULUS,
                    ]);
            });
        }
        catch (QueryException $exception)
        {
            Log::error($exception);
            throw new BusinessException('Terjadi kesalahan saat melakukan proses kelulusan');
        }
    }

    public function massRollbackSiswaLulusByTahunAjar(int $idTahunAjar)
    {
        try
        {
            return DB::transaction(function () use ($idTahunAjar) {
                $this->refSiswa
                    ->newQuery()
                    ->join('trans_penempatan_siswa', 'ref_siswa.id', '=', 'trans_penempatan_siswa.id_ref_siswa')
                    ->join('ref_kode_kelas', 'trans_penempatan_siswa.id_ref_kode_kelas', '=', 'ref_kode_kelas.id')
                    ->join('ref_kelas', 'ref_kode_kelas.id_ref_kelas', '=', 'ref_kelas.id')
                    ->join('ref_tahun_ajar', 'trans_penempatan_siswa.id_ref_tahun_ajar', '=', 'ref_tahun_ajar.id')
                    ->where('ref_tahun_ajar.id', $idTahunAjar)
                    ->where('ref_kelas.id', self::ID_REF_KELAS_XII)
                    ->where('ref_siswa.id_ref_status_siswa', self::STATUS_SISWA_LULUS)
                    ->update([
                        'ref_siswa.id_ref_status_siswa' => self::STATUS_SISWA_AKTIF,
                    ]);
            });
        }
        catch (QueryException $exception)
        {
            Log::error($exception);
            throw new BusinessException('Terjadi kesalahan saat melakukan proses kelulusan');
        }
    }
}