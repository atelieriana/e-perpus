<?php

namespace App\Repositories\References;

use App\Interfaces\References\RefKejuruanInterface;
use App\Models\References\RefKejuruan;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RefKejuruanRepository extends BaseRepository implements RefKejuruanInterface
{
    public function __construct(
        private RefKejuruan $refKejuruan
    )
    {
        parent::__construct($refKejuruan);
    }

    /**
     * @inheritDoc
     */
    public function dtDataKejuruan(int $start = null, int $end = null, string $search = null)
    {
        $subQuery = $this->refKejuruan
            ->newQuery()
            ->select([
                'uuid',
                'kejuruan'
            ])
            ->selectRaw("ROW_NUMBER() OVER (ORDER BY id asc) AS row_num");

        if ($search !== null) {
            $subQuery->whereRaw("lower(kejuruan) like ?", ["%".$search."%"]);
        }

        $query = DB::query()->fromSub($subQuery, 't');

        if ($start !== null && $end !== null) {
            $query->whereBetween('row_num', [$start, $end]);
        }

        return $query->get();
    }
}