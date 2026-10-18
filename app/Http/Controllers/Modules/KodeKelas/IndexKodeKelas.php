<?php

namespace App\Http\Controllers\Modules\KodeKelas;

use App\Http\Controllers\Controller;
use App\Traits\AuditAccess;
use Illuminate\Http\Request;

class IndexKodeKelas extends Controller
{
    use AuditAccess;

    private $moduleName = 'Kode Kelas - Index';

    public function __construct()
    {
        $this->logAccess();
    }

    public function index()
    {

    }
}
