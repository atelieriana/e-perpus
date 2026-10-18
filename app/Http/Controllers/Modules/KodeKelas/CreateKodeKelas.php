<?php

namespace App\Http\Controllers\Modules\KodeKelas;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Requests\KodeKelas\CreateRequest;
use App\Services\KejuruanService;
use App\Services\KelasService;
use App\Services\KodeKelasService;
use App\Traits\AuditAccess;
use Illuminate\Support\Str;

class CreateKodeKelas extends Controller
{
    use AuditAccess;

    private $moduleName = 'Kode Kelas - Create';

    public function __construct(
        private KodeKelasService $kodeKelasService,
        private KejuruanService $kejuruanService,
        private KelasService $kelasService
    )
    {
        $this->logAccess();
    }

    public function index()
    {
        $listKelas = $this->kelasService->getAllRecord();
        $listKejuruan = $this->kejuruanService->getAllRecord();
        return view('modules.kode-kelas.create', compact('listKelas', 'listKejuruan'));
    }

    public function onSubmit(CreateRequest $request)
    {
        $dataKelas = $this->kelasService->findByUUID($request->post('uuid-kelas'));
        $dataKejuruan = $this->kejuruanService->findByUUID($request->post('uuid-kejuruan'));
        $requestData = [
            'uuid' => Str::uuid()->toString(),
            'id_ref_kelas' => $dataKelas->id,
            'id_ref_kejuruan' => $dataKejuruan->id,
            'kode_kelas' => $request->post('kode-kelas'),
            'deskripsi' => $request->post('deskripsi'),
        ];

        try
        {
            $this->kodeKelasService->createRecordKodeKelas($requestData);
        }
        catch (BusinessException $exception)
        {
            return response()
                ->redirectToRoute('kode-kelas.create')
                ->with('error', $exception->getMessage());
        }

        return response()
            ->redirectToRoute('kode-kelas.index')
            ->with('success', 'Kode kelas berhasil ditambahkan.');
    }
}
