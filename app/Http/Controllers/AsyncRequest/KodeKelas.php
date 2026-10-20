<?php

namespace App\Http\Controllers\AsyncRequest;

use App\Http\Controllers\Controller;
use App\Services\KejuruanService;
use App\Services\KelasService;
use App\Services\KodeKelasService;
use Illuminate\Http\Request;

class KodeKelas extends Controller
{
    public function __construct(
        private KodeKelasService $kodeKelasService,
        private KelasService $kelasService,
        private KejuruanService $kejuruanService
    )
    {}

    public function getKodeKelasByKelasAndKejuruan(Request $request)
    {
        $dataKelas = $this->kelasService->findByUUID($request->post('uuid-kelas'));
        $dataKejuruan = $this->kejuruanService->findByUUID($request->post('uuid-kejuruan'));
        return json_encode($this->kodeKelasService->getKodeKelasByKelasAndKejuruan($dataKelas->id, $dataKejuruan->id));
    }
}