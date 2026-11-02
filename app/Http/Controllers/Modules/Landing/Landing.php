<?php

namespace App\Http\Controllers\Modules\Landing;

use App\Http\Controllers\Controller;
use App\Services\BukuService;
use App\Services\PeminjamanBukuUmumService;
use App\Traits\AuditAccess;

class Landing extends Controller
{
    use AuditAccess;

    // Trait variable
    protected $moduleName = 'Landing - Page';

    public function __construct(
        private BukuService $bukuService,
    )
    {
        $this->logAccess();
    }

    public function index()
    {
        $listBuku = $this->bukuService->getLatestKoleksiBuku();
        return view('modules.landing.index', compact('listBuku'));
    }
}
