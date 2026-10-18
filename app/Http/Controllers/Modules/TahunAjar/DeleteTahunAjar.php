<?php

namespace App\Http\Controllers\Modules\TahunAjar;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Requests\TahunAjar\DeleteRequest;
use App\Services\TahunAjarServices;
use App\Traits\AuditAccess;
use Illuminate\Http\RedirectResponse;

class DeleteTahunAjar extends Controller
{
    use AuditAccess;
    private $moduleName = 'Tahun Ajar - Hapus';

    public function __construct(
        private TahunAjarServices $tahunAjarServices
    )
    {
        $this->logAccess();
    }

    public function index(string $uuid)
    {
        $dataTahunAjar = $this->tahunAjarServices->findByUUID($uuid);
        if (is_null($dataTahunAjar)) {
            return response()
                ->redirectToRoute('tahun-ajar.index')
                ->with('error', 'Data tahun ajar tidak ditemukan.');
        }

        return view('modules.tahun-ajar.delete', compact('dataTahunAjar'));
    }

    /**
     * @param DeleteRequest $request
     * @return RedirectResponse
     */
    public function onSubmit(DeleteRequest $request)
    {
        $originalUUID = getOriginalUUID();
        $dataTahunAjar = $this->tahunAjarServices->findByUUID($request->post('uuid-tahun-ajar'));
        $this->validateDataAndOrigins($dataTahunAjar, $originalUUID);

        try
        {
            $this->tahunAjarServices->deleteReccordTahunAjar($dataTahunAjar->id);
        }
        catch (BusinessException $exception)
        {
            return response()
                ->redirectToRoute('tahun-ajar.delete',['uuid' => $originalUUID])
                ->withErrors($exception->getMessage());
        }

        return response()
            ->redirectToRoute('tahun-ajar.index',['uuid' => $originalUUID])
            ->with('success', 'Berhasil menghapus data tahun ajar.');
    }

    /**
     * @param $dataTahunAjar
     * @param $originalUUID
     * @return RedirectResponse|void
     */
    private function validateDataAndOrigins($dataTahunAjar, $originalUUID)
    {
        if (is_null($dataTahunAjar)) {
            return response()
                ->redirectToRoute('kejuruan.delete', ['uuid' => $originalUUID])
                ->with('error', 'Data tahun ajar tidak ditemukan.');
        }

        if ($originalUUID != $dataTahunAjar->uuid) {
            return response()
                ->redirectToRoute('kejuruan.delete', ['uuid' => $originalUUID])
                ->with('error', 'UUID telah diganti.');
        }
    }
}
