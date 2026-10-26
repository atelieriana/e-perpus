<?php

namespace App\Http\Controllers\Modules\PeminjamanBukuUmum;

use App\Http\Controllers\Controller;
use App\Services\PeminjamanBukuUmumService;
use App\Services\SiswaService;
use App\Services\StatusPeminjamanService;
use Illuminate\Http\Request;

class UpdatePeminjamanBukuUmum extends Controller
{
    public function __construct(
        private SiswaService $siswaService,
        private PeminjamanBukuUmumService $peminjamanBukuUmumService,
        private StatusPeminjamanService $statusPeminjamanService
    )
    {}

    public function index(string $uuidSiswa, string $tanggalPinjam)
    {
        $dataSiswa = $this->siswaService->findDataSiswaByUUID($uuidSiswa);
        $tanggalPinjam = base64_decode($tanggalPinjam);
        $dataPeminjaman = $this->peminjamanBukuUmumService->getPeminjamanBukuUmumByIdSiswaDanTanggalPinjam($dataSiswa->id, $tanggalPinjam);
        $listStatusPeminjaman = $this->statusPeminjamanService->getAllRecord();
        return view('modules.peminjaman-buku-umum.update', compact('dataPeminjaman','listStatusPeminjaman'));
    }

    public function onSubmit()
    {

    }
}
