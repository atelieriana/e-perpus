<?php

namespace App\Http\Controllers\Modules\BukuPaket;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Requests\BukuPaket\DeleteRequest;
use App\Services\BukuPaketService;
use App\Traits\AuditAccess;
use Illuminate\Http\Request;

class DeleteBukuPaket extends Controller
{
    use AuditAccess;

    private $moduleName = 'Buku Paket - Delete';

    public function __construct(
        private BukuPaketService $bukuPaketService,
    )
    {
        $this->logAccess();
    }

    public function index(string $uuid)
    {
        $dataBukuPaket = $this->bukuPaketService->findByUUID($uuid);
        if (is_null($dataBukuPaket)) {
            return response()
                ->redirectToRoute('buku-paket-index')
                ->with('error', 'Data Buku Paket Tidak Ditemukan.');
        }
        return view('modules.buku-paket.delete', compact('dataBukuPaket'));
    }

    public function onSubmit(DeleteRequest $request)
    {
        $originalUUID = getOriginalUUID();
        $dataBukuPaket = $this->bukuPaketService->findByUUID($request->post('uuid-buku-paket'));
        if (is_null($dataBukuPaket)) {
            return response()
                ->redirectToRoute('buku-paket-index')
                ->with('error', 'Data Buku Paket Tidak Ditemukan.');
        }

        try
        {
            $this->bukuPaketService->deleteRecordBukuPaket($dataBukuPaket->id);
        }
        catch (BusinessException $exception)
        {
            return response()
                ->redirectToRoute('buku-paket.delete', ['uuid' => $originalUUID])
                ->with('error', 'Data buku gagal dihapus.');
        }

        return response()
            ->redirectToRoute('buku-paket.index')
            ->with('success', 'Data Buku Paket Berhasil Dihapus.');
    }
}
