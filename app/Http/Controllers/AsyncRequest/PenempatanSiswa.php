<?php

namespace App\Http\Controllers\AsyncRequest;

use App\Http\Controllers\Controller;
use App\Services\KejuruanService;
use App\Services\KelasService;
use App\Services\KodeKelasService;
use App\Services\PenempatanSiswaService;
use App\Services\TahunAjarServices;
use Illuminate\Http\Request;

class PenempatanSiswa extends Controller
{
    public function __construct(
        private PenempatanSiswaService $penempatanSiswaService,
    )
    {}

    public function listPenempatanSiswa(Request $request)
    {
        $requestData = [
            'uuid-ref-kelas' => $request->post('uuid-ref-kelas'),
            'uuid-ref-kode-kelas' => $request->post('uuid-ref-kode-kelas'),
            'uuid-ref-tahun-ajar' => $request->post('uuid-ref-tahun-ajar'),
        ];

        return $this->penempatanSiswaService->getListPenempatanSiswa($requestData);
    }
}