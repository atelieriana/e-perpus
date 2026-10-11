<?php

namespace App\Http\Controllers\Modules\Siswa;

use App\Http\Controllers\Controller;
use App\Traits\AuditAccess;
use Illuminate\Http\Request;

class IndexSiswa extends Controller
{
    use AuditAccess;
    private $moduleName = 'Siswa - Index';

    public function __construct()
    {
        $this->logAccess();
    }

    public function index()
    {
        return view('modules.siswa.index');
    }
}
