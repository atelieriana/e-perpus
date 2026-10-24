<?php

namespace App\Repositories\References;

use App\Interfaces\References\RefKodeKelasInterface;
use App\Models\References\RefKodeKelas;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RefKodeKelasRepository extends BaseRepository implements RefKodeKelasInterface
{
    public function __construct(
        private RefKodeKelas $refKodeKelas
    )
    {
        parent::__construct($refKodeKelas);
    }

    public function dtKodeKelas(int $start = null, int $end = null, string $search = null)
    {
        $subQuery = $this->refKodeKelas
            ->newQuery()
            ->select([
                'ref_kode_kelas.uuid',
                'id_ref_kelas',
                'id_ref_kejuruan',
                'kode_kelas',
                'kejuruan',
                DB::raw("CONCAT('Kelas ', kelas) as kelas"),
                'deskripsi'
            ])
            ->selectRaw("ROW_NUMBER() OVER (ORDER BY ref_kode_kelas.id asc) AS row_num")
            ->join('ref_kejuruan', 'ref_kode_kelas.id_ref_kejuruan', '=', 'ref_kejuruan.id')
            ->join('ref_kelas', 'ref_kode_kelas.id_ref_kelas', '=', 'ref_kelas.id');

        if ($search !== null) {
            $subQuery->where(function ($query) use ($search) {
                $query->whereRaw("lower(kode_kelas) like ?", ["%".$search."%"]);
                $query->orWhereRaw("lower(kejuruan) like ?", ["%".$search."%"]);
                $query->orWhereRaw("lower(CONCAT('Kelas ', kelas)) like ?", ["%".$search."%"]);
            });
        }

        $query = DB::query()
            ->fromSub($subQuery, 't');

        if ($start !== null && $end !== null) {
            $query->whereBetween('row_num', [$start, $end]);
        }

        return $query->get();
    }

    public function findByUUID(string $uuid)
    {
        return $this->refKodeKelas
            ->newQuery()
            ->with(['ref_kejuruan', 'ref_kelas'])
            ->where('uuid', $uuid)
            ->first();
    }

    public function getKodeKelasByKelasAndKejuruan(int $idRefKelas, int $idRefKejuruan)
    {
        return $this->refKodeKelas
            ->newQuery()
            ->select([
                'uuid',
                'kode_kelas',
            ])
            ->where('id_ref_kelas', $idRefKelas)
            ->where('id_ref_kejuruan', $idRefKejuruan)
            ->get();
    }


}