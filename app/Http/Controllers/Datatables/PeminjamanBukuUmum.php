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
                $html = '<ul>';
                for($i = 0; $i < count($arrayBuku); $i++) {
                    $html .= "<li>".$arrayBuku[$i]."</li>";
                }
                $html .= '</ul>';
                return $html;
            })
            ->editColumn('tanggal_mulai_pinjam', function ($peminjaman) {
                return Carbon::parse($peminjaman->tanggal_mulai_pinjam)->format('d F Y');
            })
            ->editColumn('tanggal_akhir_pinjam', function ($peminjaman) {
                return Carbon::parse($peminjaman->tanggal_akhir_pinjam)->format('d F Y');
            })
            ->addColumn('status_peminjaman', function ($dataPeminjaman) {
                $arrayStatusPeminjman = explode(",", $dataPeminjaman->status_peminjaman);
                if (count($arrayStatusPeminjman) > 1) {
                    if (count(array_filter($arrayStatusPeminjman, fn($v) => $v == '1')) === count($arrayStatusPeminjman)) {
                        return "Dipinjam";
                    }

                    if(in_array('2', $arrayStatusPeminjman) && in_array('3', $arrayStatusPeminjman)) {
                        return 'Kembali Sebagian';
                    }
                    if (in_array('1', $arrayStatusPeminjman) && in_array('2', $arrayStatusPeminjman) && in_array('4', $arrayStatusPeminjman)) {
                        return 'Kembali Sebagian';
                    }

                    else
                    {
                        if (count(array_filter($arrayStatusPeminjman, fn($v) => $v == '2')) === count($arrayStatusPeminjman)) {
                            return "Telah dikembalikan";
                        }
                        else
                        {
                            if (in_array('4', $arrayStatusPeminjman) && in_array('2', $arrayStatusPeminjman)) {
                                return 'Telah dikembalikan';
                            }
                            else
                            {
                                return 'Kembali sebagian';
                            }
                        }
                    }
                }
                else
                {
                    if ($arrayStatusPeminjman[0] == '1') {
                        return 'Dipinjam';
                    }
                    if ($arrayStatusPeminjman[0] == '2') {
                        return 'Telah dikembalikan';
                    }
                    if ($arrayStatusPeminjman[0] == '3') {
                        return 'Hilang';
                    }
                    if ($arrayStatusPeminjman[0] == '4') {
                        return 'Telah dikembalikan';
                    }
                }
            })
            ->addColumn('aksi', function ($dataPeminjaman) {
                return '<div class="row">
                            <div class="col-md-6">
                                <a href="'.route('peminjaman-buku-umum.update',['uuid' => $dataPeminjaman->uuid, 'tanggalPinjam' => base64_encode($dataPeminjaman->tanggal_mulai_pinjam)]).'" data-toggle="tooltip" title="Ubah">
                                    <i class="mdi mdi-pen text-success"></i>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="'.route('peminjaman-buku-umum.delete',['uuid' =>  $dataPeminjaman->uuid, 'tanggalPinjam' => base64_encode($dataPeminjaman->tanggal_mulai_pinjam)]).'" data-toggle="tooltip" title="Hapus">
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