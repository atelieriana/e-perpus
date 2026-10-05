<?php

namespace App\Http\Controllers\Modules\BukuPelajaran;

use App\Http\Controllers\Controller;
use App\Services\BukuService;
use App\Traits\AuditAccess;

class IndexBukuPelajaran extends Controller
{
    use AuditAccess;
    private $moduleName = 'Buku Pelajaran - Index';

    public function index()
    {
        return view('modules.buku.index');
    }
}