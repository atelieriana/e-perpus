<?php

namespace App\Http\Controllers\Datatables;

use App\Http\Controllers\Controller;
use App\Services\TahunAjarServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TahunAjar extends Controller
{
    public function __construct(
        private TahunAjarServices $tahunAjarServices
    )
    {}

    public function __invoke(Request $request)
    {
        $startData = (int)$request->input('start');
        $endData = $startData + $request->input('length');
        $searchData = strtolower($request->post('search')['value']);
        if ($startData == '0') {
            $request->merge(['start' => 0]);
        } else {
            $request->merge(['start' => 1]);
        }

        $dataTahunAjar = $this->tahunAjarServices->getDatatablesTahunAjar($startData, $endData, $searchData);
        $totalDataTahunAjar = $this->tahunAjarServices->getDatatablesTahunAjar(null, null, $searchData)->count();
        return DataTables::of($dataTahunAjar)
            ->addIndexColumn()
            ->editColumn('tanggal_mulai', function ($dataTahunAjar) {
                return Carbon::parse($dataTahunAjar->tanggal_mulai)->translatedFormat('d F Y');
            })
            ->editColumn('tanggal_akhir', function ($dataTahunAjar) {
                return Carbon::parse($dataTahunAjar->tanggal_akhir)->translatedFormat('d F Y');
            })
            ->addColumn('aksi', function ($dataTahunAjar) {
                return '<div class="row">
                            <div class="col-md-6">
                                <a href="'.route('tahun-ajar.update',['uuid' => $dataTahunAjar->uuid]).'" data-toggle="tooltip" title="Ubah">
                                    <i class="mdi mdi-pen text-success"></i>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="'.route('tahun-ajar.delete',['uuid' =>  $dataTahunAjar->uuid]).'" data-toggle="tooltip" title="Hapus">
                                    <i class="mdi mdi-trash-can text-danger"></i>
                                </a>
                            </div>
                        </div>';
            })
            ->rawColumns(['aksi'])
            ->setFilteredRecords($totalDataTahunAjar)
            ->setTotalRecords($totalDataTahunAjar)
            ->make();
    }
}