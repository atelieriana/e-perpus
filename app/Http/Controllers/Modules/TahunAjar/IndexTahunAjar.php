<?php

namespace App\Http\Controllers\Modules\TahunAjar;

use App\Http\Controllers\Controller;
use App\Services\TahunAjarServices;
use App\Traits\AuditAccess;
use Illuminate\Http\Request;

class IndexTahunAjar extends Controller
{
    use AuditAccess;
    private $moduleName = 'Tahun Ajar - Index';

    public function __construct()
    {
        $this->logAccess();
    }

    public function index()
    {
        return view ('modules.tahun-ajar.index');
    }
}
