<?php

namespace App\Repositories\References;

use App\Interfaces\References\RefBukuInterface;
use App\Models\References\RefBuku;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class RefBukuRepository extends BaseRepository implements RefBukuInterface
{
    public function __construct(protected RefBuku $refBuku)
    {
        parent::__construct($refBuku);
    }

    public function findDataByIdJenisBuku(int $id, int $start = null, int $end = null)
    {
        $subQuery = $this->refBuku
            ->newQuery()
            ->select('*')
            ->selectRaw("ROW_NUMBER() OVER (ORDER BY id asc) AS row_num")
            ->where('id_ref_jenis_buku', $id);

        $query = DB::query()->fromSub($subQuery, 't');

        if ($start !== null && $end !== null) {
            $query->whereBetween('row_num', [$start, $end]);
        }

        return $query->get();
    }
}