<?php

namespace App\Http\Controllers\Modules\BukuPaket;

use App\Http\Controllers\Controller;
use App\Http\Requests\BukuPaket\DeleteRequest;
use App\Traits\AuditAccess;
use Illuminate\Http\Request;

class DeleteBukuPaket extends Controller
{
    use AuditAccess;

    private $moduleName = 'Buku Paket - Delete';

    public function __construct()
    {
        $this->logAccess();
    }

    public function index(string $uuid)
    {

    }

    public function onSubmit(DeleteRequest $request)
    {

    }
}
