<?php

namespace App\Repositories\References;

use App\Interfaces\References\RefTahunAjarInterface;
use App\Models\References\RefTahunAjar;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RefTahunAjarRepository extends BaseRepository implements RefTahunAjarInterface
{
    public function __construct(
        private RefTahunAjar $refTahunAjar
    )
    {
        parent::__construct($refTahunAjar);
    }

    public function dtDataKejuruan(int $start = null, int $end = null, string $search = null)
    {
        $subQuery = $this->refTahunAjar
            ->newQuery()
            ->select([
                'uuid',
                'tahun_ajar',
                'tanggal_mulai',
                'tanggal_akhir'
            ])
            ->selectRaw("ROW_NUMBER() OVER (ORDER BY id asc) AS row_num");

        if ($search !== null) {
            $subQuery->whereRaw("tahun_ajar like ?", ["%".$search."%"]);
        }

        $query = DB::query()->fromSub($subQuery, 't');

        if ($start !== null && $end !== null) {
            $query->whereBetween('row_num', [$start, $end]);
        }

        return $query->get();
    }
}