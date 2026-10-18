<?php

namespace App\Http\Controllers\Modules\KodeKelas;

use App\Exceptions\BusinessException;
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

    public function index(string $uuid)
    {
        $dataKodeKelas = $this->kodeKelasService->findByUUID($uuid);
        return view('modules.kode-kelas.delete', compact('dataKodeKelas'));
    }

    public function onSubmit(DeleteRequest $request)
    {
        $dataKodeKelas = $this->kodeKelasService->findByUUID($request->post('uuid-kode-kelas'));

        try
        {
            $this->kodeKelasService->deleteRecordKodeKelas($dataKodeKelas->id);
        }
        catch (BusinessException $exception)
        {
            return repsonse()
                ->redirectToRoute('kode-kelas.delete',['uuid' => $request->post('uuid-kode-kelas')])
                ->with('error', $exception->getMessage());
        }

        return response()
            ->redirectToRoute('kode-kelas.index')
            ->with('success', 'Berhasil menghapus Kode Kelas.');
    }
}
