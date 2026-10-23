<?php

namespace App\Http\Controllers\KenaikanKelas;

use App\Http\Controllers\Controller;
use App\Services\KelasService;
use App\Services\KodeKelasService;
use App\Services\TahunAjarServices;
use Illuminate\Http\Request;

class IndexKenaikanKelas extends Controller
{
    public function __construct(
        private KelasService $kelasService,
        private TahunAjarServices $tahunAjarService,
    )
    {}

    public function index()
    {
        $listKelas = $this->kelasService->getRecordKelasXDanXII();
        $listTahunAjar = $this->tahunAjarService->getAllRecord();
        return view('modules.kenaikan-kelas.index', compact('listKelas', 'listTahunAjar'));
    }
}
