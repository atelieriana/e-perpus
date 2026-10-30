<?php

namespace App\Http\Controllers\Datatables;

use App\Http\Controllers\Controller;
use App\Services\SuratBebasPinjamService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SuratBebasPinjam extends Controller
{
    public function __construct(
        private SuratBebasPinjamService $bebasSuratPinjamService
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

        $dataBukuPaket = $this->bebasSuratPinjamService->getDatatablesBebasPustaka($startData, $endData, $searchData);
        $totalBukuPaket = $this->bebasSuratPinjamService->getDatatablesBebasPustaka(null, null, $searchData)->count();
        return DataTables::of($dataBukuPaket)
            ->addIndexColumn()
            ->addColumn('aksi', function ($dataBukuPaket) {
                return '<div class="row">
                            <div class="col-md-6">
                                <a href="'.route('buku-paket.update',['uuid' => $dataBukuPaket->uuid]).'" data-toggle="tooltip" title="Ubah">
                                    <i class="mdi mdi-pen text-success"></i>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="'.route('buku-paket.delete',['uuid' =>  $dataBukuPaket->uuid]).'" data-toggle="tooltip" title="Hapus">
                                    <i class="mdi mdi-trash-can text-danger"></i>
                                </a>
                            </div>
                        </div>';
            })
            ->rawColumns(['aksi'])
            ->setFilteredRecords($totalBukuPaket)
            ->setTotalRecords($totalBukuPaket)
            ->make();
    }
}