<?php

namespace App\Http\Controllers\Datatables;

use App\Http\Controllers\Controller;
use App\Services\PeminjamanBukuUmumService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PeminjamanBukuUmum extends Controller
{
    public function __construct(
        private PeminjamanBukuUmumService $peminjamanBukuUmumService
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

        $dataPeminjaman = $this->peminjamanBukuUmumService->getDatatablesPemeinjamanUmum($startData, $endData, $searchData);
        $totalDataPeminjaman = $this->peminjamanBukuUmumService->getDatatablesPemeinjamanUmum(null, null, $searchData)->count();

        return DataTables::of($dataPeminjaman)
            ->addIndexColumn()
            ->addColumn('buku', function ($dataPeminjaman) {
                $arrayBuku = explode(",", $dataPeminjaman->judul);
                $html = '';
                for($i = 0; $i < count($arrayBuku); $i++) {
                    $html .= "<li>".$arrayBuku[$i]."</li>";
                }
                return $html;
            })
            ->editColumn('tanggal_mulai_pinjam', function ($peminjaman) {
                return Carbon::parse($peminjaman->tanggal_mulai_pinjam)->format('d F Y');
            })
            ->editColumn('tanggal_akhir_pinjam', function ($peminjaman) {
                return Carbon::parse($peminjaman->tanggal_akhir_pinjam)->format('d F Y');
            })
            ->addColumn('aksi', function ($dataPeminjaman) {
                return '<div class="row">
                            <div class="col-md-6">
                                <a href="'.route('peminjaman-buku-umum.update',['uuid' => $dataPeminjaman->uuid, 'tanggalPinjam' => base64_encode($dataPeminjaman->tanggal_mulai_pinjam)]).'" data-toggle="tooltip" title="Ubah">
                                    <i class="mdi mdi-pen text-success"></i>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="'.route('peminjaman-buku-umum.delete',['uuid' =>  $dataPeminjaman->uuid]).'" data-toggle="tooltip" title="Hapus">
                                    <i class="mdi mdi-trash-can text-danger"></i>
                                </a>
                            </div>
                        </div>';
            })
            ->rawColumns(['buku','aksi'])
            ->setFilteredRecords($totalDataPeminjaman)
            ->setTotalRecords($totalDataPeminjaman)
            ->make();
    }
}