<?php

namespace App\Repositories\References;

use App\Interfaces\References\RefBukuPaketInterface;
use App\Models\References\RefBukuPaket;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RefBukuPaketRepository extends BaseRepository implements RefBukuPaketInterface
{
    public function __construct(
        private RefBukuPaket $refBukuPaket
    )
    {
        parent::__construct($refBukuPaket);
    }

    public function dtDataBukuPaket(int $start = null, int $end = null, string $search = null)
    {
        $subQuery = $this->refBukuPaket
            ->newQuery()
            ->select([
                'ref_buku_paket.id',
                'ref_buku_paket.uuid',
                'ref_buku.judul',
                'ref_kelas.kelas',
                'ref_kejuruan.kejuruan'
            ])
            ->join('ref_buku', 'ref_buku.id', '=', 'ref_buku_paket.id_ref_buku')
            ->join('ref_kelas', 'ref_kelas.id', '=', 'ref_buku_paket.id_ref_kelas')
            ->join('ref_kejuruan', 'ref_kejuruan.id', '=', 'ref_buku_paket.id_ref_kejuruan')
            ->selectRaw("ROW_NUMBER() OVER (ORDER BY id asc) AS row_num");

        if ($search !== null) {
            $subQuery->where(function ($query) use ($search) {
                $query->whereRaw("lower(judul) like ?", ["%".$search."%"])
                    ->orWhereRaw("lower(penulis) like ?", ["%".$search."%"])
                    ->orWhereRaw("lower(penerbit) like ?", ["%".$search."%"])
                    ->orWhereRaw("lower(isbn) like ?", ["%".$search."%"]);
            });
        }

        $query = DB::query()->fromSub($subQuery, 't');

        if ($start !== null && $end !== null) {
            $query->whereBetween('row_num', [$start, $end]);
        }

        return $query->get();
    }

    public function findByIdRefKejuruanDanKelas(int $idRefKejuruan, int $idRefKelas)
    {
        // TODO: Implement findByIdRefKejuruanDanKelas() method.
    }
}