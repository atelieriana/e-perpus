<?php

namespace App\Http\Controllers\Datatables;

use App\Http\Controllers\Controller;
use App\Services\SiswaService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class Siswa extends Controller
{
    public function __construct(
        private SiswaService $siswaService
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

        $dataSiswa = $this->siswaService->getDatatablesSiswa($startData, $endData, $searchData);
        $totalSiswa = $this->siswaService->getDatatablesSiswa(null, null, $searchData)->count();
        return DataTables::of($dataSiswa)
            ->addIndexColumn()
            ->editColumn('gender', function ($dataSiswa){
                if ($dataSiswa->gender === 1) {
                    return 'Laki-laki';
                } else {
                    return 'Perempuan';
                }
            })
            ->addColumn('aksi', function ($dataBuku) {
                return '<div class="row">
                            <div class="col-md-4">
                                <a href="'.route('buku-umum.update',['uuid' => $dataBuku->uuid]).'" data-toggle="tooltip" title="lihat">
                                    <i class="mdi mdi-eye text-primary"></i>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="'.route('buku-umum.update',['uuid' => $dataBuku->uuid]).'" data-toggle="tooltip" title="Ubah">
                                    <i class="mdi mdi-pen text-success"></i>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="'.route('buku-umum.delete',['uuid' =>  $dataBuku->uuid]).'" data-toggle="tooltip" title="Hapus">
                                    <i class="mdi mdi-trash-can text-danger"></i>
                                </a>
                            </div>
                        </div>';
            })
            ->rawColumns(['aksi'])
            ->setFilteredRecords($totalSiswa)
            ->setTotalRecords($totalSiswa)
            ->make();
    }
}