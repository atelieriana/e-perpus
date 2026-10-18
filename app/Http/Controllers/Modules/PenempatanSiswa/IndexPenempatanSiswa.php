<?php

namespace App\Http\Controllers\Modules\PenempatanSiswa;

use App\Http\Controllers\Controller;
use App\Traits\AuditAccess;
use Illuminate\Http\Request;

class IndexPenempatanSiswa extends Controller
{
    use AuditAccess;
    private $moduleName = 'Penempatan Siswa - Index';

    public function __construct()
    {
        $this->logAccess();
    }

    public function index()
    {

    }
}
