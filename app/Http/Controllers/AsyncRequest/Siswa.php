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

    public function getSiswaBerdasarkanKelasDanKejuruan(Request $request)
    {
        $uuidRefKelas = $request->post('uuid-ref-kelas');
        $uuidRefKejuruan = $request->post('uuid-ref-kejuruan');
        return json_encode($this->siswaService->getSiswaByKelasDanKodeKejuruan($uuidRefKelas, $uuidRefKejuruan));
    }

    public function getSiswaBerdasarkanKelasKejuruanTahun(Request $request)
    {
        $uuidRefKelas = $request->post('uuid-ref-kelas');
        $uuidRefKejuruan = $request->post('uuid-ref-kejuruan');
        $uuidRefTahunAjar = $request->post('uuid-ref-tahun-ajar');
        return json_encode($this->siswaService->getSiswaByKelasKejuruanDanTahunAjar($uuidRefKelas, $uuidRefKejuruan, $uuidRefTahunAjar));
    }
}