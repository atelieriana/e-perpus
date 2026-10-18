<?php

namespace App\Http\Controllers\Modules\KodeKelas;

use App\Http\Controllers\Controller;
use App\Http\Requests\KodeKelas\CreateRequest;
use App\Services\KodeKelasService;
use App\Traits\AuditAccess;

class CreateKodeKelas extends Controller
{
    use AuditAccess;

    private $moduleName = 'Kode Kelas - Create';

    public function __construct(
        private KodeKelasService $kodeKelasService
    )
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
