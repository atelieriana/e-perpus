<?php

namespace App\Http\Controllers\Datatables;

use App\Http\Controllers\Controller;
use App\Services\PeminjamanBukuUmumService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PeminjamanMendekatiBatasAkhir extends Controller
{
    public function __construct(
        private PeminjamanBukuUmumService $peminjamanBukuUmumService
    )
    {}

    public function __invoke(Request $request)
    {
        $startData = (int)$request->post('start');
        $endData = $startData + $request->post('length');
        $searchData = strtolower($request->post('search')['value']);
        if ($startData == '0') {
            $request->merge(['start' => 0]);
        } else {
            $request->merge(['start' => 1]);
        }

        $dataPeminjaman = $this->peminjamanBukuUmumService->dtPeminjamanBukuUmumMendekatiBatasAkhir($startData, $endData, $searchData);
        $totalDataPeminjaman = $this->peminjamanBukuUmumService->dtPeminjamanBukuUmumMendekatiBatasAkhir(null, null, $searchData)->count();
        return DataTables::of($dataPeminjaman)
            ->addIndexColumn()
            ->setFilteredRecords($totalDataPeminjaman)
            ->setTotalRecords($totalDataPeminjaman)
            ->make();
    }
}