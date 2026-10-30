<?php

namespace App\Http\Controllers\Datatables;

use App\Http\Controllers\Controller;
use App\Services\HistoryPeminjamanService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class HistoryPeminjaman extends Controller
{
    public function __construct(
        private HistoryPeminjamanService $historyPeminjamanService
    )
    {}

    public function __invoke(Request $request)
    {
        $uuidRefSiswa = $request->post('uuid-ref-siswa');
        $startData = (int)$request->post('start');
        $endData = $startData + $request->post('length');
        $searchData = strtolower($request->post('search')['value']);
        if ($startData == '0') {
            $request->merge(['start' => 0]);
        } else {
            $request->merge(['start' => 1]);
        }

        $dataHistoryPeminjaman = $this->historyPeminjamanService->dtPeminjamanBukuByIdSiswa($uuidRefSiswa, $startData, $endData, $searchData);
        $totalHistoryPeminjaman = $this->historyPeminjamanService->dtPeminjamanBukuByIdSiswa($uuidRefSiswa, null, null, $searchData)->count();
        return DataTables::of($dataHistoryPeminjaman)
            ->addIndexColumn()
            ->editColumn('tanggal_mulai_pinjam', function ($data) {
                Carbon::setLocale('id');
                return Carbon::parse($data->tanggal_mulai_pinjam)->translatedFormat('d F Y');
            })
            ->editColumn('tanggal_pengembalian', function ($data) {
                Carbon::setLocale('id');
                if ($data->tanggal_pengembalian == null) {
                    return '-';
                }
                else
                {
                    return Carbon::parse($data->tanggal_pengembalian)->translatedFormat('d F Y');
                }
            })
            ->setFilteredRecords($totalHistoryPeminjaman)
            ->setTotalRecords($totalHistoryPeminjaman)
            ->make();
    }
}