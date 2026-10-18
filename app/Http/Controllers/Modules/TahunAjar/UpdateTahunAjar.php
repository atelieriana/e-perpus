<?php

namespace App\Http\Controllers\Modules\TahunAjar;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Requests\TahunAjar\UpdateRequest;
use App\Services\TahunAjarServices;
use App\Traits\AuditAccess;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UpdateTahunAjar extends Controller
{
    use AuditAccess;
    private $moduleName = 'Tahun Ajar - Update';

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

        return view('modules.tahun-ajar.update',compact('dataTahunAjar'));
    }

    public function onSubmit(UpdateRequest $request)
    {
        $originalUUID = getOriginalUUID();
        $dataTahunAjar = $this->tahunAjarServices->findByUUID($request->post('uuid-tahun-ajar'));

        $this->validateDataAndOrigins($dataTahunAjar, $originalUUID);

        $requestData = [
            'tahun_ajar' => $request->post('tahun-ajar'),
            'tanggal_mulai' => $request->post('tanggal-mulai'),
            'tanggal_akhir' => $request->post('tanggal-akhir'),
        ];

        try
        {
            $this->tahunAjarServices->updateReccordTahunAjar($requestData, $dataTahunAjar->id);
        }
        catch (BusinessException $exception)
        {
            return response()
                ->redirectToRoute('tahun-ajar.update', ['uuid' => $originalUUID])
                ->with('error', $exception->getMessage());
        }

        return response()
            ->redirectToRoute('tahun-ajar.index')
            ->with('success', 'Data tahun ajar berhasil diupdate');
    }

    /**
     * @param $dataKejuruan
     * @param $originalUUID
     * @return RedirectResponse|void
     */
    private function validateDataAndOrigins($dataKejuruan, $originalUUID)
    {
        if (is_null($dataKejuruan)) {
            return response()
                ->redirectToRoute('tahun-ajar.update', ['uuid' => $originalUUID])
                ->with('error', 'Data tahun ajar tidak ditemukan.');
        }

        if ($originalUUID !== $dataKejuruan->uuid) {
            return response()
                ->redirectToRoute('tahun-ajar.update', ['uuid' => $originalUUID])
                ->with('error', 'UUID telah diubah.');
        }
    }
}
