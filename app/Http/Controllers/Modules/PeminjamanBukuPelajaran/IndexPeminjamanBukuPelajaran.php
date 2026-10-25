<?php

namespace App\Http\Controllers\Modules\PeminjamanBukuPelajaran;

use App\Http\Controllers\Controller;
use App\Services\KejuruanService;
use App\Services\KelasService;
use App\Services\TahunAjarServices;
use Illuminate\Http\Request;

class IndexPeminjamanBukuPelajaran extends Controller
{
    public function __construct(
        private KelasService $kelasService,
        private KejuruanService $kejuruanService,
        private TahunAjarServices $tahunAjarService,
    )
    {}

    public function index()
    {
        $listKelas = $this->kelasService->getAllRecord();
        $listKejuruan = $this->kejuruanService->getAllRecord();
        $listTahunAjar = $this->tahunAjarService->getAllRecord();
        return view('modules.peminjaman-buku-pelajaran.index', compact('listKelas','listKejuruan','listTahunAjar'));
    }
}
