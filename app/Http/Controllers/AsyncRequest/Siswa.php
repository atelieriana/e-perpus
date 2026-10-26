<?php

namespace App\Http\Controllers\AsyncRequest;

use App\Http\Controllers\Controller;
use App\Services\SiswaService;
use Illuminate\Http\Request;

class Siswa extends Controller
{
    public function __construct(
        private SiswaService $siswaService,
    )
    {}

    public function getSiswaBerdasarkanKodeKelasDanTahun(Request $request)
    {
        $uuidRefKelas = $request->post('uuid-ref-kelas');
        $uuidRefKejuruan = $request->post('uuid-ref-kejuruan');
        return json_encode($this->siswaService->getSiswaByKelasDanKodeKejuruan($uuidRefKelas, $uuidRefKejuruan));
    }
}