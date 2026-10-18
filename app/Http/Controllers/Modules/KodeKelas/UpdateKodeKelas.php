<?php

namespace App\Http\Controllers\Modules\KodeKelas;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Requests\KodeKelas\UpdateRequest;
use App\Services\KejuruanService;
use App\Services\KelasService;
use App\Services\KodeKelasService;
use App\Traits\AuditAccess;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UpdateKodeKelas extends Controller
{
    use AuditAccess;

    private $moduleName = 'Kode Kelas - Update';

    public function __construct(
        private KodeKelasService $kodeKelasService,
        private KelasService $kelasService,
        private KejuruanService $kejuruanService
    )
    {
        $this->logAccess();
    }

    public function index(string $uuid)
    {
        $dataKodeKelas = $this->kodeKelasService->findByUUID($uuid);
        $listKelas = $this->kelasService->getAllRecord();
        $listKejuruan = $this->kejuruanService->getAllRecord();
        return view('modules.kode-kelas.update', compact('dataKodeKelas','listKelas','listKejuruan'));
    }

    public function onSubmit(UpdateRequest $request)
    {
        $originalUUID = getOriginalUUID();
        $dataKodeKelas = $this->kodeKelasService->findByUUID($request->post('uuid-kode-kelas'));
        $dataKelas = $this->kelasService->findByUUID($request->post('uuid-kelas'));
        $dataKejuruan = $this->kejuruanService->findByUUID($request->post('uuid-kejuruan'));
        $this->validateDataAndOrigins($dataKodeKelas, $originalUUID);

        $requestData = [
            'id_ref_kelas' => $dataKelas->id,
            'id_ref_kejuruan' => $dataKejuruan->id,
            'kode_kelas' => $request->post('kode-kelas'),
            'deskripsi' => $request->post('deskripsi'),
        ];

        try
        {
            $this->kodeKelasService->updateRecordKodeKelas($requestData, $dataKodeKelas->id);
        }
        catch (BusinessException $exception)
        {
            return response()
                ->redirectToRoute('kode-kelas.update',['uuid' => $originalUUID])
                ->withErrors($exception->getMessage());
        }

        return response()
            ->redirectToRoute('kode-kelas.index')
            ->with('success','Data kode kelas berhasil diupdate.');
    }

    /**
     * @param $dataKodeKelas
     * @param $originalUUID
     * @return RedirectResponse|void
     */
    private function validateDataAndOrigins($dataKodeKelas, $originalUUID)
    {
        if (is_null($dataKodeKelas)) {
            return response()
                ->redirectToRoute('kode-kelas.update', ['uuid' => $originalUUID])
                ->with('error', 'Data Kode Kelas tidak ditemukan.');
        }

        if ($dataKodeKelas->uuid !== $originalUUID) {
            return response()
                ->redirectToRoute('kode-kelas.update', ['uuid' => $originalUUID])
                ->with('error', 'UUID telah diubah.');
        }
    }
}
