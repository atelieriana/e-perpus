<?php

namespace App\Http\Controllers\Datatables;

use App\Http\Controllers\Controller;
use App\Services\HibahBukuService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class HibahBuku extends Controller
{
    public function __construct(
        private HibahBukuService $hibahBukuService
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

        $dataHibahBuku = $this->hibahBukuService->getDatatablesHibahBuku($startData, $endData, $searchData);
        $totalDataHibahBuku = $this->hibahBukuService->getDatatablesHibahBuku(null, null, $searchData)->count();

        return DataTables::of($dataHibahBuku)
            ->addIndexColumn()
            ->addColumn('aksi', function ($dataHibahBuku) {
                return '<div class="row">
                            <div class="col-md-6">
                                <a href="'.route('hibah-buku.update',['uuid' => $dataHibahBuku->uuid]).'" data-toggle="tooltip" title="Ubah">
                                    <i class="mdi mdi-pen text-success"></i>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="'.route('hibah-buku.update',['uuid' =>  $dataHibahBuku->uuid]).'" data-toggle="tooltip" title="Hapus">
                                    <i class="mdi mdi-trash-can text-danger"></i>
                                </a>
                            </div>
                        </div>';
            })
            ->rawColumns(['aksi'])
            ->setFilteredRecords($totalDataHibahBuku)
            ->setTotalRecords($totalDataHibahBuku)
            ->make();
    }
}