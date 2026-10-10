<?php

namespace App\Http\Controllers\Datatables;

use App\Http\Controllers\Controller;
use App\Services\BukuService;
use App\Traits\AuditAccess;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BukuUmum extends Controller
{
    use AuditAccess;

    private $moduleName = 'Datatables Buku Umum';

    public function __construct(
        private BukuService $bukuService,
    )
    {
        $this->logAccess();
    }

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

        $dataBuku = $this->bukuService->getDatatablesBukuUmum($startData, $endData, $searchData);
        $totalBuku = $this->bukuService->getDatatablesBukuUmum(null, null, $searchData)->count();
        return DataTables::of($dataBuku)
            ->addIndexColumn()
            ->addColumn('aksi', function ($dataBuku) {
                return '<div class="row">
                            <div class="col-md-6">
                                <a href="'.route('buku-umum.update',['uuid' => $dataBuku->uuid]).'" data-toggle="tooltip" title="Ubah">
                                    <i class="mdi mdi-pen text-success"></i>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="'.route('buku-umum.delete',['uuid' =>  $dataBuku->uuid]).'" data-toggle="tooltip" title="Hapus">
                                    <i class="mdi mdi-trash-can text-danger"></i>
                                </a>
                            </div>
                        </div>';
            })
            ->rawColumns(['aksi'])
            ->setFilteredRecords($totalBuku)
            ->setTotalRecords($totalBuku)
            ->make();
    }
}