<?php

namespace App\Http\Controllers\Modules\ValidasiSurat;

use App\Http\Controllers\Controller;
use App\Services\SuratBebasPinjamService;

class ValidasiSurat extends Controller
{
    public function __construct(
        private SuratBebasPinjamService $suratBebasPinjamService
    )
    {}

    public function __invoke(string $uuidSuratBebasPinjam)
    {
        $this->suratBebasPinjamService->findByUUID($uuidSuratBebasPinjam);
        return view('modules.validasi-surat.index');
    }
}