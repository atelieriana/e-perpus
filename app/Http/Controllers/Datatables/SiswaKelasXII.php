<?php

namespace App\Http\Controllers\Datatables;

use App\Http\Controllers\Controller;
use App\Services\PenempatanSiswaService;
use App\Services\TahunAjarServices;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SiswaKelasXII extends Controller
{
    public function __construct(
        private PenempatanSiswaService $penempatanSiswaService,
    )
    {}

    public function __invoke(Request $request)
    {
        $uuidRefTahunAjar = $request->post('uuid-ref-tahun-ajar');
        $startData = (int)$request->post('start');
        $endData = $startData + $request->post('length');
        $searchData = strtolower($request->post('search')['value']);
        if ($startData == '0') {
            $request->merge(['start' => 0]);
        } else {
            $request->merge(['start' => 1]);
        }

        $listSiswaKelasXII = $this->penempatanSiswaService->getSiswaKelasXII($uuidRefTahunAjar, $startData, $endData, $searchData);
        $totalDataSiswaKelasXII = $this->penempatanSiswaService->getSiswaKelasXII($uuidRefTahunAjar, null, null, $searchData)->count();

        return DataTables::of($listSiswaKelasXII)
            ->addIndexColumn()
            ->setFilteredRecords($totalDataSiswaKelasXII)
            ->setTotalRecords($totalDataSiswaKelasXII)
            ->make();
    }
}