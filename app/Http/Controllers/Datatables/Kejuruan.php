<?php

namespace App\Http\Controllers\Datatables;

use App\Http\Controllers\Controller;
use App\Services\KejuruanService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class Kejuruan extends Controller
{
    public function __construct(
        private KejuruanService $kejuruanService
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

        $dataKejuruan = $this->kejuruanService->getDatatablesKejuruan($startData, $endData, $searchData);
        $totalDataKejuruan = $this->kejuruanService->getDatatablesKejuruan(null, null, $searchData)->count();
        return DataTables::of($dataKejuruan)
            ->addIndexColumn()
            ->addColumn('aksi', function ($dataKejuruan) {
                return '<div class="row">
                            <div class="col-md-6">
                                <a href="'.route('buku-umum.update',['uuid' => $dataKejuruan->uuid]).'" data-toggle="tooltip" title="Ubah">
                                    <i class="mdi mdi-pen text-success"></i>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="'.route('buku-umum.delete',['uuid' =>  $dataKejuruan->uuid]).'" data-toggle="tooltip" title="Hapus">
                                    <i class="mdi mdi-trash-can text-danger"></i>
                                </a>
                            </div>
                        </div>';
            })
            ->rawColumns(['aksi'])
            ->setFilteredRecords($totalDataKejuruan)
            ->setTotalRecords($totalDataKejuruan)
            ->make();
    }
}
