<?php

namespace App\Http\Controllers\Modules\KodeKelas;

use App\Http\Controllers\Controller;
use App\Http\Requests\KodeKelas\DeleteRequest;
use App\Services\KodeKelasService;
use App\Traits\AuditAccess;

class DeleteKodeKelas extends Controller
{
    use AuditAccess;

    private $moduleName = 'Kode Kelas - Delete';

    public function __construct(
        private KodeKelasService $kodeKelasService
    )
    {
        $this->logAccess();
    }

    public function index()
    {

    }

    public function onSubmit(DeleteRequest $request)
    {

    }
}
