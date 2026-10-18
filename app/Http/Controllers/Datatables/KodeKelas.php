<?php

namespace App\Http\Controllers\Datatables;

use App\Http\Controllers\Controller;
use App\Services\KodeKelasService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KodeKelas extends Controller
{
    public function __construct(
        private KodeKelasService $kodeKelasService
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

        $dataKodeKelas = $this->kodeKelasService->getDatatablesKodeKelas($startData, $endData, $searchData);
        $totalDataKelas = $this->kodeKelasService->getDatatablesKodeKelas(null, null, $searchData)->count();
        return DataTables::of($dataKodeKelas)
            ->addColumn('kejuruan', function($dataKodeKelas) {
                return $dataKodeKelas->kejuruan;
            })
            ->addColumn('kelas', function($dataKodeKelas) {
                return $dataKodeKelas->kelas;
            })
            ->addColumn('aksi', function ($dataKodeKelas) {
                return '<div class="row">
                            <!--<div class="col-md-4">
                                <a href="'.route('kode-kelas.update',['uuid' => $dataKodeKelas->uuid]).'" data-toggle="tooltip" title="lihat">
                                    <i class="mdi mdi-eye text-primary"></i>
                                </a>
                            </div>-->
                            <div class="col-md-4">
                                <a href="'.route('kode-kelas.update',['uuid' => $dataKodeKelas->uuid]).'" data-toggle="tooltip" title="Ubah">
                                    <i class="mdi mdi-pen text-success"></i>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="'.route('kode-kelas.delete',['uuid' =>  $dataKodeKelas->uuid]).'" data-toggle="tooltip" title="Hapus">
                                    <i class="mdi mdi-trash-can text-danger"></i>
                                </a>
                            </div>
                        </div>';
            })
            ->rawColumns(['aksi'])
            ->setFilteredRecords($totalDataKelas)
            ->setTotalRecords($totalDataKelas)
            ->make();
    }
}