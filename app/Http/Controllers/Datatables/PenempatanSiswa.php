<?php

namespace App\Http\Controllers\Datatables;

use App\Http\Controllers\Controller;
use App\Services\PenempatanSiswaService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PenempatanSiswa extends Controller
{
    public function __construct(
        private PenempatanSiswaService $penempatanSiswaService
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

        $arrayParameter = [
            'uuid-ref-kelas' => $request->post('uuid-ref-kelas'),
            'uuid-ref-kejuruan' => $request->post('uuid-ref-kejuruan'),
            'uuid-ref-tahun-ajar' => $request->post('uuid-ref-tahun-ajar'),
            'uuid-ref-kode-kelas' => $request->post('uuid-ref-kode-kelas'),
        ];

        $dataSiswa = $this->penempatanSiswaService->getDatatablesPenempatanSiswa($arrayParameter, $startData, $endData, $searchData);
        $totalSiswa = $this->penempatanSiswaService->getDatatablesPenempatanSiswa($arrayParameter, null, null, $searchData)->count();

        return DataTables::of($dataSiswa)
            ->editColumn('jenis_kelamin', function ($dataSiswa) {
                if ($dataSiswa->jenis_kelamin === 1) {
                    return 'Laki-laki';
                }
                else
                {
                    return 'Perempuan';
                }
            })
            ->addColumn('aksi', function ($dataSiswa) {
                return '<div class="row">
                            <!--<div class="col-md-4">
                                <a href="'.route('kode-kelas.update',['uuid' => $dataSiswa->uuid]).'" data-toggle="tooltip" title="lihat">
                                    <i class="mdi mdi-eye text-primary"></i>
                                </a>
                            </div>-->
                            <div class="col-md-4">
                                <a href="'.route('kode-kelas.update',['uuid' => $dataSiswa->uuid]).'" data-toggle="tooltip" title="Ubah">
                                    <i class="mdi mdi-pen text-success"></i>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="'.route('kode-kelas.delete',['uuid' =>  $dataSiswa->uuid]).'" data-toggle="tooltip" title="Hapus">
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
