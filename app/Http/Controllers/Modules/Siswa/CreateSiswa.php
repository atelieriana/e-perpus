<?php

namespace App\Http\Controllers\Modules\Siswa;

use App\Http\Controllers\Controller;
use App\Models\References\RefStatusSiswa;
use App\Services\SiswaService;
use App\Services\StatusSiswaService;
use App\Traits\AuditAccess;

class CreateSiswa extends Controller
{
    use AuditAccess;
    private $moduleName = 'Siswa - Buat';

    public function __construct(
        private SiswaService $siswaService,
        private StatusSiswaService $statusSiswaService,
    )
    {}

    public function index()
    {
        $listStatusSiswa = $this->statusSiswaService->getAllStatus();
        return view('modules.siswa.create', compact('listStatusSiswa'));
    }

    public function onSubmit()
    {

    }
}