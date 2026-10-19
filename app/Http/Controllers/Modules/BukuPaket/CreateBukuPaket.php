<?php

namespace App\Http\Controllers\Modules\BukuPaket;

use App\Http\Controllers\Controller;
use App\Http\Requests\BukuPaket\CreateRequest;
use App\Traits\AuditAccess;
use Illuminate\Http\Request;

class CreateBukuPaket extends Controller
{
    use AuditAccess;

    private $moduleName = 'Buku Paket - Create';
    public function __construct()
    {
        $this->logAccess();
    }

    public function index()
    {

    }

    public function onSubmit(CreateRequest $request)
    {

    }
}
