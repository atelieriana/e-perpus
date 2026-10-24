<?php

namespace App\Http\Controllers\Datatables;

use App\Http\Controllers\Controller;
use App\Services\SiswaService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KenaikanKelas extends Controller
{
    public function __construct(
        private SiswaService $siswaService,
    )
    {}

    public function __invoke(Request $request)
    {
        $uuidRefKelas = $request->post('uuid-ref-kelas');
        $uuidRefTahunAjar = $request->post('uuid-ref-tahun-ajar');
        $startData = (int)$request->post('start');
        $endData = $startData + $request->post('length');
        $searchData = strtolower($request->post('search')['value']);
        if ($startData == '0') {
            $request->merge(['start' => 0]);
        } else {
            $request->merge(['start' => 1]);
        }

        $listSiswa = $this->siswaService->getDatatablesSiswaByKelasDanTahunBerjalan($uuidRefTahunAjar, $uuidRefKelas, $startData, $endData, $searchData);
        $totalSiswa = $this->siswaService->getDatatablesSiswaByKelasDanTahunBerjalan($uuidRefTahunAjar, $uuidRefKelas, null, null, $searchData)->count();

        return DataTables::of($listSiswa)
            ->addIndexColumn()
            ->setTotalRecords($totalSiswa)
            ->setFilteredRecords($totalSiswa)
            ->make();
    }
}