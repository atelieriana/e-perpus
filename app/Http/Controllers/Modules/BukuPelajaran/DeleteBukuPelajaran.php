<?php

namespace App\Http\Controllers\Modules\BukuPelajaran;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Requests\BukuPelajaran\DeleteRequest;
use App\Services\BukuService;
use App\Traits\AuditAccess;

class DeleteBukuPelajaran extends Controller
{
    use AuditAccess;
    private $moduleName = 'Buku Pelajaran - Hapus';

    public function __construct(
        private BukuService $bukuService
    )
    {
        $this->logAccess();
    }

    public function index(string $uuid)
    {
        $dataBuku = $this->bukuService->findDataBukuByUUID($uuid);
        return view('modules.buku-pelajaran.delete', compact('dataBuku'));
    }

    public function onSubmit(DeleteRequest $request)
    {
        $uuidBuku = $request->post('uuid-buku');
        $dataBuku = $this->bukuService->findDataBukuByUUID($uuidBuku);

        try
        {
            $this->bukuService->deleteRecordBuku($dataBuku->id);
            return response()
                ->redirectToRoute('buku-pelajaran.index')
                ->with(['success' => 'Data berhasil buku pelajaran berhasil dihapus']);
        }
        catch (BusinessException $exception)
        {
            return response()
                ->redirectToRoute('buku-pelajaran.hapus', ['uuid' => $uuidBuku])
                ->with('error', $exception->getMessage());
        }
    }
}