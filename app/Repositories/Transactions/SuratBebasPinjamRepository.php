<?php

namespace App\Repositories\Transactions;

use App\Interfaces\Transactions\SuratBebasPinjamInterface;
use App\Models\Transactions\SuratBebasPinjam;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SuratBebasPinjamRepository extends BaseRepository implements SuratBebasPinjamInterface
{
    public function __construct(
        private SuratBebasPinjam $bebasPustaka
    )
    {
        parent::__construct($bebasPustaka);
    }

    public function dtBebasPustaka(int $start = null, int $end = null, string $search = null)
    {
        $subQuery = $this->bebasPustaka
            ->newQuery()
            ->select([
                'ref_siswa.nomor_induk',
                'ref_siswa.nama_lengkap',
                'ref_tahun_ajar.tahun_ajar',
                'ref_kelas.kelas',
                'ref_kode_kelas.kode_kelas',
                'trans_surat_bebas_pinjam.tanggal_surat',
                DB::raw('ROW_NUMBER() OVER (ORDER BY trans_surat_bebas_pinjam.id ASC) AS row_num'),
            ])
            ->join('ref_siswa', 'trans_surat_bebas_pinjam.id_ref_siswa', '=', 'ref_siswa.id')
            ->join('trans_penempatan_siswa', 'ref_siswa.id', '=', 'trans_penempatan_siswa.id_ref_siswa')
            ->join('ref_tahun_ajar', 'trans_penempatan_siswa.id_ref_tahun_ajar', '=', 'ref_tahun_ajar.id')
            ->join('ref_kode_kelas', 'trans_penempatan_siswa.id_ref_kode_kelas', '=', 'ref_kode_kelas.id')
            ->join('ref_kelas', 'ref_kode_kelas.id_ref_kelas', '=', 'ref_kelas.id');

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
}