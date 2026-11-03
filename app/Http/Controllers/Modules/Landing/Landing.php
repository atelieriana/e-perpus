<?php

namespace App\Http\Controllers\Modules\Landing;

use App\Http\Controllers\Controller;
use App\Services\BukuService;
use App\Services\PeminjamanBukuUmumService;
use App\Traits\AuditAccess;
use Illuminate\Http\Request;

class Landing extends Controller
{
    use AuditAccess;

    // Trait variable
    protected $moduleName = 'Landing - Page';

    public function __construct(
        private BukuService $bukuService,
        private PeminjamanBukuUmumService $peminjamanBukuUmumService
    )
    {
        $this->logAccess();
    }

    public function index()
    {
        $listKoleksiBukuBaru = $this->bukuService->getLatestKoleksiBuku();
        $listPeminjamTerbanyak = $this->peminjamanBukuUmumService->getPeminjamanTerbanyak();
        return view('modules.landing.index', compact('listKoleksiBukuBaru','listPeminjamTerbanyak'));
    }

    public function katalogBuku(Request $request)
    {
        $listBuku = null;
        if (!is_null($request->input('pencarian')))
        {
            $listBuku = $this->bukuService->getBukuByParam(strtolower($request->input('pencarian')));
        }
        return view('modules.landing.katalog-buku', compact('listBuku'));
    }
}
