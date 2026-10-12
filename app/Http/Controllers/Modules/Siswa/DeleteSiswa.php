<?php

namespace App\Http\Controllers\Modules\Siswa;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Siswa\DeleteRequest;
use App\Services\SiswaService;
use App\Services\StatusSiswaService;
use App\Traits\AuditAccess;

class DeleteSiswa extends Controller
{
    use AuditAccess;
    private $moduleName = 'Siswa - Delete';

    public function __construct(
        private SiswaService $siswaService,
    )
    {
        $this->logAccess();
    }

    public function index(string $uuid)
    {
        $dataSiswa = $this->siswaService->findDataSiswaByUUID($uuid);
        return view('modules.siswa.delete', compact('dataSiswa'));
    }

    public function onSubmit(DeleteRequest $request)
    {
        $dataSiswa = $this->siswaService->findDataSiswaByUUID($request->post('uuid-siswa'));
        try
        {
            $this->siswaService->deleteRecordSiswa($dataSiswa->id);
            return response()
                ->redirectToRoute('siswa.index')
                ->with('success', 'Data siswa berhasil dihapus.');
        }
        catch (BusinessException $exception)
        {
            return response()
                ->redirectToRoute('siswa.delete', ['uuid' => $request->post('uuid-siswa')])
                ->with('error', $exception->getMessage());
        }
    }
}