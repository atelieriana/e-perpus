<?php

namespace App\Repositories\References;

use App\Interfaces\References\RefSiswaInterface;
use App\Models\References\RefSiswa;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RefSiswaIRepository extends BaseRepository implements RefSiswaInterface
{
    const GENDER_LAKI_LAKI = 1;
    const GENDER_PEREMPUAN = 0;

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
}