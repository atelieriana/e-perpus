<?php

namespace App\Repositories\Transactions;

use App\Interfaces\Transactions\PenempatanSiswaInterface;
use App\Models\References\RefTahunAjar;
use App\Models\Transactions\PenempatanSiswa;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PenempatanSiswaRepository extends BaseRepository implements PenempatanSiswaInterface
{
    const STATUS_SISWA_AKTIF = 1;

    public function __construct(
        private PenempatanSiswa $penempatanSiswa,
        private RefTahunAjar $refTahunAjar,
    )
    {
        parent::__construct($penempatanSiswa);
    }

    /**
     * @inheritDoc
     */
    public function listPenempatanSiswa(array $params)
    {
        return $this->penempatanSiswa
            ->newQuery()
            ->select([
                'trans_penempatan_siswa.uuid',
                'ref_siswa.uuid as uuid_ref_siswa',
                'ref_siswa.nisn',
                'ref_siswa.nomor_induk',
                'ref_siswa.nama_lengkap',
                'ref_siswa.gender as jenis_kelamin',
                'ref_kelas.uuid as uuid_ref_kelas',
                'ref_kelas.kelas',
                'ref_kejuruan.kejuruan',
                'ref_kode_kelas.uuid as uuid_ref_kode_kelas',
                'ref_kode_kelas.kode_kelas',
                'ref_tahun_ajar.uuid as uuid_ref_tahun_ajar',
                'ref_tahun_ajar.tahun_ajar',
            ])
            ->selectRaw("ROW_NUMBER() OVER (ORDER BY ref_siswa.id, ref_siswa.nama_lengkap) AS row_num")
            ->join('ref_siswa', 'trans_penempatan_siswa.id_ref_siswa', '=', 'ref_siswa.id')
            ->join('ref_kode_kelas', 'trans_penempatan_siswa.id_ref_kode_kelas', '=', 'ref_kode_kelas.id')
            ->join('ref_tahun_ajar', 'trans_penempatan_siswa.id_ref_tahun_ajar', '=', 'ref_tahun_ajar.id')
            ->join('ref_kelas', 'ref_kode_kelas.id_ref_kelas', '=', 'ref_kelas.id')
            ->join('ref_kejuruan','ref_kode_kelas.id_ref_kejuruan','=','ref_kejuruan.id')
            ->where('ref_kelas.uuid', $params['uuid-ref-kelas'])
            ->where('ref_tahun_ajar.uuid', $params['uuid-ref-tahun-ajar'])
            ->where('ref_kode_kelas.uuid', $params['uuid-ref-kode-kelas'])
            ->where('ref_siswa.id_ref_status_siswa', self::STATUS_SISWA_AKTIF)
            ->orderBy('ref_siswa.nama_lengkap','asc')
            ->get();
    }

    public function getSiswaKelasXII(string $uuidRefTahunAjar, int $startData = null, int $endData = null, string $searchData = null)
    {

        $subQuery = $this->penempatanSiswa
            ->newQuery()
            ->select(
                'ref_siswa.nisn',
                'ref_siswa.nomor_induk',
                'ref_siswa.nama_lengkap',
                'ref_status_siswa.status_siswa',
                'ref_kelas.kelas',
                'ref_kejuruan.kejuruan',
                'ref_kode_kelas.kode_kelas',
                'ref_tahun_ajar.tahun_ajar',
            )
            ->selectRaw("ROW_NUMBER() OVER (ORDER BY kejuruan asc, kode_kelas asc, nama_lengkap asc) AS row_num")
            ->join('ref_siswa', 'trans_penempatan_siswa.id_ref_siswa', '=', 'ref_siswa.id')
            ->join('ref_status_siswa', 'ref_siswa.id_ref_status_siswa', '=', 'ref_status_siswa.id')
            ->join('ref_kode_kelas', 'trans_penempatan_siswa.id_ref_kode_kelas', '=', 'ref_kode_kelas.id')
            ->join('ref_kelas', 'ref_kode_kelas.id_ref_kelas', '=', 'ref_kelas.id')
            ->join('ref_kejuruan', 'ref_kode_kelas.id_ref_kejuruan', '=', 'ref_kejuruan.id')
            ->join('ref_tahun_ajar', 'trans_penempatan_siswa.id_ref_tahun_ajar', '=', 'ref_tahun_ajar.id')
            ->where('ref_kode_kelas.id_ref_kelas', 3)
            ->where('ref_tahun_ajar.uuid', $uuidRefTahunAjar);

        $query = DB::query()->fromSub($subQuery, 't');

        if ($startData !== null && $endData !== null) {
            $query->whereBetween('row_num', [$startData, $endData]);
        }

        return $query->get();
    }

    public function massUpdateKenaikanKelasSiswa(int $idRefTahunAjar)
    {
        $this->penempatanSiswa
            ->newQuery();
    }

    public function massRollbackKenaikanKelasSiswa()
    {
        // TODO: Implement massRollbackKenaikanKelasSiswa() method.
    }


    public function getSiswaKelasXOrXI(int $idTahunAjar, int $idKelas)
    {
        return $this->penempatanSiswa
            ->newQuery()
            ->join('ref_kode_kelas','trans_penempatan_siswa.id_ref_kode_kelas','=','ref_kode_kelas.id')
            ->join('ref_kelas','ref_kode_kelas.id_ref_kelas','=','ref_kelas.id')
            ->where('id_ref_tahun_ajar', $idTahunAjar)
            ->where('id_ref_kelas', $idKelas)
            ->get();
    }

    public function getSiswaByKodeKelasDanTahunAjar(int $idKodeKelas, int $idTahunAjar)
    {
        return $this->penempatanSiswa
            ->newQuery()
            ->select([
                'ref_siswa.uuid',
                'ref_siswa.nisn',
                'ref_siswa.nomor_induk',
                'ref_siswa.nama_lengkap',
            ])
            ->join('ref_siswa','trans_penempatan_siswa.id_ref_siswa','=','ref_siswa.id')
            ->where('trans_penempatan_siswa.id_ref_kode_kelas', $idKodeKelas)
            ->where('trans_penempatan_siswa.id_ref_tahun_ajar', $idTahunAjar)
            ->get();
    }
}