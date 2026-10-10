<?php

namespace App\Http\Controllers\Modules\BukuUmum;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Requests\BukuUmum\DeleteRequest;
use App\Services\BukuService;
use App\Traits\AuditAccess;

class DeleteBukuUmum extends Controller
{
    use AuditAccess;
    private $moduleName = 'Buku umum - Hapus';

    public function __construct(
        private BukuService $bukuService
    )
    {
        $this->logAccess();
    }

    public function index(string $uuid)
    {
        $dataBuku = $this->bukuService->findDataBukuByUUID($uuid);
        return view('modules.buku-umum.delete', compact('dataBuku'));
    }

    public function onSubmit(DeleteRequest $request)
    {
        $uuidBuku = $request->post('uuid-buku');
        $dataBuku = $this->bukuService->findDataBukuByUUID($uuidBuku);

        try
        {
            $this->bukuService->deleteRecordBuku($dataBuku->id);
            return response()
                ->redirectToRoute('buku-umum.index')
                ->with(['success' => 'Data berhasil buku umum berhasil dihapus']);
        }
        catch (BusinessException $exception)
        {
            return response()
                ->redirectToRoute('buku-umum.hapus', ['uuid' => $uuidBuku])
                ->with('error', $exception->getMessage());
        }
    }
}