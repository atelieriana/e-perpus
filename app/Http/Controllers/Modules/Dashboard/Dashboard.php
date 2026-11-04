<?php

namespace App\Http\Controllers\Modules\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\BukuService;
use App\Services\PeminjamanBukuPelajaranService;
use App\Services\PeminjamanBukuUmumService;
use App\Services\SiswaService;
use App\Services\TahunAjarServices;
use App\Services\UserService;

class Dashboard extends Controller
{
    public function __construct(
        private SiswaService $siswaServices,
        private BukuService $bukuServices,
        private PeminjamanBukuUmumService $peminjamanBukuUmumService,
        private PeminjamanBukuPelajaranService $peminjamanBukuPelajaranService,
    )
    {}

    public function index()
    {
        $accessRole = session()->get('access-role');
        if ($accessRole === "Admin")
            return $this->adminDashboard();
        else if ($accessRole === "Pustakawan")
            return null;
    }

    private function adminDashboard()
    {
        $dataSiswa = $this->siswaServices->getSiswaAktif()->count();
        $dataBuku = $this->bukuServices->getTotalBuku();
        $dataPeminjamanBukuUmum = $this->peminjamanBukuUmumService->getTotalPeminjamanBukuUmum();
        $dataPeminjamanBukuPelajaran = $this->peminjamanBukuPelajaranService->getTotalPeminjamanBukuPelajaran();
        $totalPeminjaman = $dataPeminjamanBukuPelajaran+$dataPeminjamanBukuUmum+$dataPeminjamanBukuUmum;
        return view('modules.dashboard.index', compact('dataSiswa','dataBuku','totalPeminjaman'));
    }
}