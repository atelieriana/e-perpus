<?php

namespace App\Http\Controllers\Modules\BukuUmum;

use App\Http\Controllers\Controller;
use App\Traits\AuditAccess;

class IndexBukuUmum extends Controller
{
    use AuditAccess;
    private $moduleName = 'Buku Umum - Index';

    public function index()
    {
        return view('modules.buku-umum.index');
    }
}