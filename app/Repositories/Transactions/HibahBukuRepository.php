<?php

namespace App\Repositories\Transactions;

use App\Interfaces\Transactions\HibahBukuInterface;
use App\Models\Transactions\HibahBuku;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class HibahBukuRepository extends BaseRepository implements HibahBukuInterface
{
    public function __construct(
        private HibahBuku $hibahBuku
    )
    {
        parent::__construct($hibahBuku);
    }

    public function dtHibahBuku(int $start = null, int $end = null, string $search = null)
    {
        $subQuery = $this->hibahBuku
            ->newQuery()
            ->select([
                'trans_hibah_buku.uuid',
                'ref_siswa.nomor_induk',
                'ref_siswa.nama_lengkap',
                'ref_buku.judul',
                DB::raw('ROW_NUMBER() OVER (ORDER BY trans_hibah_buku.id ASC) AS row_num'),
            ])
            ->join('ref_buku', 'ref_buku.id', '=', 'trans_hibah_buku.id_ref_buku')
            ->join('ref_siswa', 'ref_siswa.id', '=', 'trans_hibah_buku.id_ref_siswa');

        if ($search !== null) {
            $subQuery->where(function ($query) use ($search) {
                $query->whereRaw("lower(nama_lengkap) like ?", ["%".$search."%"])
                    ->orWhereRaw("lower(nomor_induk) like ?", ["%".$search."%"])
                    ->orWhereRaw("lower(judul) like ?", ["%".$search."%"]);
            });
        }

        $query = DB::query()->fromSub($subQuery, 't');

        if ($start !== null && $end !== null) {
            $query->whereBetween('row_num', [$start, $end]);
        }

        return $query->get();
    }

    public function checkHibahByIdSiswa(int $idSiswa)
    {
        return $this->hibahBuku->newQuery()
            ->where('id_ref_siswa', $idSiswa)
            ->count();
    }
}