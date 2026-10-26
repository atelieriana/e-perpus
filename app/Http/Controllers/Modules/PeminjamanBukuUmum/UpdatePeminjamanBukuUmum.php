<?php

namespace App\Http\Controllers\Modules\PeminjamanBukuUmum;

use App\Http\Controllers\Controller;
use App\Services\PeminjamanBukuUmumService;
use App\Services\SiswaService;
use Illuminate\Http\Request;

class UpdatePeminjamanBukuUmum extends Controller
{
    public function __construct(
        private SiswaService $siswaService,
        private PeminjamanBukuUmumService $peminjamanBukuUmumService
    )
    {}

    public function index(string $uuidSiswa, string $tanggalPinjam)
    {
        $dataSiswa = $this->siswaService->findDataSiswaByUUID($uuidSiswa);
        $tanggalPinjam = base64_decode($tanggalPinjam);
        $this->peminjamanBukuUmumService->getPeminjamanBukuUmumByIdSiswaDanTanggalPinjam($dataSiswa->id, $tanggalPinjam);
    }

    public function onSubmit()
    {

    }
}
