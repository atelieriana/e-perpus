<?php

namespace App\Repositories\Transactions;

use App\Exceptions\BusinessException;
use App\Interfaces\Transactions\PeminjamanBukuServiceInterface;
use App\Models\Transactions\PeminjamanBuku;
use App\Repositories\BaseRepository;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PeminjamanBukuRepository extends BaseRepository implements PeminjamanBukuServiceInterface
{
    public function __construct(
        private PeminjamanBuku $peminjamanBuku
    )
    {
        parent::__construct($peminjamanBuku);
    }

    public function getPeminjamanBukuByKodeKelasDanTahun(int $idRefKodeKelas, int $idRefTahunAjar)
    {
        return $this->peminjamanBuku
            ->newQuery()
            ->select(
                'ref_siswa.uuid as uuid_ref_siswa',
                'ref_siswa.nama_lengkap',
                'ref_buku.uuid as uuid_ref_buku',
                'ref_buku.judul',
                'ref_status_peminjaman.uuid as uuid_ref_status_peminjaman',
                'ref_status_peminjaman.status_peminjaman'
            )
            ->join('ref_siswa', 'trans_peminjaman_buku.id_ref_siswa', '=', 'ref_siswa.id')
            ->join('trans_penempatan_siswa', 'ref_siswa.id', '=', 'trans_penempatan_siswa.id_ref_siswa')
            ->join('ref_buku', 'trans_peminjaman_buku.id_ref_buku', '=', 'ref_buku.id')
            ->join('ref_tahun_ajar', 'trans_penempatan_siswa.id_ref_tahun_ajar', '=', 'ref_tahun_ajar.id')
            ->join('ref_status_peminjaman', 'trans_peminjaman_buku.id_ref_status_peminjaman', '=', 'ref_status_peminjaman.id')
            ->where('ref_tahun_ajar.id', $idRefTahunAjar)
            ->where('trans_penempatan_siswa.id_ref_kode_kelas', $idRefKodeKelas)
            ->orderBy('ref_buku.judul')
            ->get();
    }

    public function massUpsert($arrayData)
    {
        try
        {
            return DB::transaction(function () use ($arrayData){
                return $this->peminjamanBuku
                    ->newQuery()
                    ->upsert($arrayData, ['id_ref_buku','id_ref_jenis_peminjaman','id_ref_siswa'],[
                        'id_ref_status_peminjaman' => $arrayData['id_ref_status_peminjaman'],
                    ]);
            });
        }
        catch (QueryException $exception)
        {
            Log::error($exception);
            throw new BusinessException('Terjadi kesalahan saat menyimpan data peminjaman buku');
        }

    }
}