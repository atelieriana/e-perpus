<?php

namespace App\Http\Controllers\Modules\Siswa;

use App\Http\Controllers\Controller;
use App\Services\SiswaService;
use App\Services\StatusSiswaService;
use App\Traits\AuditAccess;

class UpdateSiswa extends Controller
{
    use AuditAccess;
    private $moduleName = 'Siswa - Update';

    public function __construct(
        private SiswaService $siswaService,
        private StatusSiswaService $statusSiswaService
    )
    {}

    public function index(string $uuid)
    {
        $dataSiswa = $this->siswaService->findDataSiswaByUUID($uuid);
        $listStatusSiswa = $this->statusSiswaService->getAllStatus();
        return view('modules.siswa.update', compact('dataSiswa','listStatusSiswa'));
    }

    public function onSubmit()
    {

    }
}