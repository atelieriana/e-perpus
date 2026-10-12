<?php

namespace App\Repositories\References;

use App\Interfaces\References\RefSiswaInterface;
use App\Models\References\RefSiswa;
use App\Repositories\BaseRepository;
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
}