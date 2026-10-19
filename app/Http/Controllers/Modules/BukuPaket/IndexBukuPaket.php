<?php

namespace App\Http\Controllers\Modules\BukuPaket;

use App\Http\Controllers\Controller;
use App\Traits\AuditAccess;
use Illuminate\Http\Request;

class IndexBukuPaket extends Controller
{
    use AuditAccess;

    private $moduleName = 'Buku Paket - Index';

    public function __construct()
    {
        $this->logAccess();
    }

    public function index()
    {

    }
}
