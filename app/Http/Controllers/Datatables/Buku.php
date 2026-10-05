<?php

namespace App\Http\Controllers\Datatables;

use App\Http\Controllers\Controller;
use App\Services\BukuService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class Buku extends Controller
{
    public function __construct(
        private BukuService $bukuService,
    )
    {}

    public function __invoke(Request $request)
    {
        $startData = (int)$request->input('start');
        $endData = $startData + $request->input('length');
        if ($startData == '0') {
            $request->merge(['start' => 0]);
        } else {
            $request->merge(['start' => 1]);
        }

        $dataBuku = $this->bukuService->getDatatablesBukuPelajaran($startData, $endData);
        $totalBuku = count($this->bukuService->getDatatablesBukuPelajaran());
        return DataTables::of($dataBuku)
            ->addIndexColumn()
            ->addColumn('aksi', function ($dataBuku) {
                return '<div class="row">
                            <div class="col-md-6">
                                <a href="#" data-toggle="tooltip" title="Ubah">
                                    <i class="mdi mdi-pen text-success"></i>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="#" data-toggle="tooltip" title="Hapus">
                                    <i class="mdi mdi-trash-can text-danger"></i>
                                </a>
                            </div>
                        </div>';
            })
            ->rawColumns(['aksi'])
            ->setFilteredRecords($totalBuku)
            ->setFilteredRecords($totalBuku)
            ->make();
    }
}