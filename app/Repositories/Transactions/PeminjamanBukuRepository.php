<?php

namespace App\Repositories\Transactions;

use App\Exceptions\BusinessException;
use App\Interfaces\Transactions\PeminjamanBukuInterface;
use App\Models\References\RefBuku;
use App\Models\Transactions\PeminjamanBuku;
use App\Repositories\BaseRepository;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PeminjamanBukuRepository extends BaseRepository implements PeminjamanBukuInterface
{
    const STATUS_PEMINJAMAN_BUKU_UMUM = 2;

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
                        'tanggal_pengembalian' => (isset($arrayData['tanggal_pengembalian'])) ? $arrayData['tanggal_pengembalian'] : null,
                    ]);
            });
        }
        catch (QueryException $exception)
        {
            Log::error($exception);
            throw new BusinessException('Terjadi kesalahan saat menyimpan data peminjaman buku');
        }

    }

    public function dtDataPeminjamanBukuUmum(int $start = null, int $end = null, string $search = null)
    {
        $subQuery = $this->peminjamanBuku
            ->newQuery()
            ->join('ref_siswa as rs', 'trans_peminjaman_buku.id_ref_siswa', '=', 'rs.id')
            ->join('ref_buku as rb', 'trans_peminjaman_buku.id_ref_buku', '=', 'rb.id')
            ->where('trans_peminjaman_buku.id_ref_jenis_peminjaman', 2)
            ->whereNull('trans_peminjaman_buku.deleted_at')
            ->whereRaw('LOWER(rs.nama_lengkap) LIKE ?', ["%{$search}%"])
            ->select([
                'rs.uuid',
                'rs.nomor_induk',
                'rs.nama_lengkap',
                DB::raw("GROUP_CONCAT(rb.judul ORDER BY trans_peminjaman_buku.id SEPARATOR ',') AS judul"),
                DB::raw("GROUP_CONCAT(trans_peminjaman_buku.id_ref_status_peminjaman ORDER BY trans_peminjaman_buku.id SEPARATOR ',') AS status_peminjaman"),
                'trans_peminjaman_buku.tanggal_mulai_pinjam',
                'trans_peminjaman_buku.tanggal_akhir_pinjam',
                DB::raw('ROW_NUMBER() OVER (ORDER BY MIN(trans_peminjaman_buku.id) ASC) AS row_num'),
            ])
            ->groupBy(
                'rs.uuid',
                'rs.nomor_induk',
                'rs.nama_lengkap',
                'trans_peminjaman_buku.tanggal_mulai_pinjam',
                'trans_peminjaman_buku.tanggal_akhir_pinjam'
            );

        if ($search !== null) {
            $subQuery->where(function ($query) use ($search) {
                $query->whereRaw("lower(nama_lengkap) like ?", ["%".$search."%"]);
            });
        }

        $query = DB::query()->fromSub($subQuery, 't');

        if ($start !== null && $end !== null) {
            $query->whereBetween('row_num', [$start, $end]);
        }

        return $query->get();
    }

    public function getPeminjamanBySiswaDanTanggalPinjam(int $idRefSiswa, string $tanggalPinjam)
    {
        return $this->peminjamanBuku
            ->newQuery()
            ->select([
                'ref_siswa.uuid as uuid_ref_siswa',
                'ref_siswa.nama_lengkap',
                'ref_buku.judul',
                'tanggal_mulai_pinjam',
                'tanggal_akhir_pinjam',
                'ref_status_peminjaman.uuid as uuid_ref_status_peminjaman',
                'trans_peminjaman_buku.uuid as uuid_trans_peminjaman_buku',
            ])
            ->join('ref_siswa', 'trans_peminjaman_buku.id_ref_siswa', '=', 'ref_siswa.id')
            ->join('ref_buku', 'trans_peminjaman_buku.id_ref_buku', '=', 'ref_buku.id')
            ->join('ref_status_peminjaman', 'trans_peminjaman_buku.id_ref_status_peminjaman', '=', 'ref_status_peminjaman.id')
            ->where('id_ref_siswa', $idRefSiswa)
            ->where('tanggal_mulai_pinjam', $tanggalPinjam)
            ->where('id_ref_jenis_peminjaman', self::STATUS_PEMINJAMAN_BUKU_UMUM)
            ->get();
    }
}