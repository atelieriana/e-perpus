<?php

namespace App\Http\Controllers\Modules\BukuPaket;

use App\Http\Controllers\Controller;
use App\Http\Requests\BukuPaket\UpdateRequest;
use App\Traits\AuditAccess;
use Illuminate\Http\Request;

class UpdateBukuPaket extends Controller
{
    use AuditAccess;

    private $moduleName = 'Buku Paket - Update';

    public function __construct()
    {
        $this->logAccess();
    }

    public function index(string $uuid)
    {

    }

    public function onSubmit(UpdateRequest $request)
    {

    }
}
