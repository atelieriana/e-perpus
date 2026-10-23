<?php

namespace App\Http\Controllers\Datatables;

use App\Http\Controllers\Controller;
use App\Services\KodeKelasService;
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
        $uuidRefTahun = $request->post('uuid-ref-tahun-ajar');
        $uuidRefKelas = $request->post('uuid-ref-kelas');
        $startData = (int)$request->post('start');
        $endData = $startData + $request->post('length');
        $searchData = strtolower($request->post('search')['value']);
        if ($startData == '0') {
            $request->merge(['start' => 0]);
        } else {
            $request->merge(['start' => 1]);
        }

        $listSiswa = $this->siswaService->getDatatablesSiswaByKelasDanTahunAjar($uuidRefTahun, $uuidRefKelas, $startData, $endData, $searchData);
        $totalSiswa = $this->siswaService->getDatatablesSiswaByKelasDanTahunAjar($uuidRefTahun, $uuidRefKelas, null, null, $searchData)->count();

        return DataTables::of($listSiswa)
            ->addIndexColumn()
            ->setTotalRecords($totalSiswa)
            ->setFilteredRecords($totalSiswa)
            ->make();
    }
}