<?php

namespace App\Http\Controllers\Modules\KodeKelas;

use App\Http\Controllers\Controller;
use App\Http\Requests\KodeKelas\UpdateRequest;
use App\Services\KodeKelasService;
use App\Traits\AuditAccess;
use Illuminate\Http\Request;

class UpdateKodeKelas extends Controller
{
    use AuditAccess;

    public function __construct(
        private KodeKelasService $kodeKelasService
    )
    {
        $this->logAccess();
    }

    public function index()
    {

    }

    public function onSubmit(UpdateRequest $request)
    {

    }
}
