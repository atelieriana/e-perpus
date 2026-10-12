<?php

namespace App\Http\Controllers\Modules\Siswa;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Siswa\UpdateRequest;
use App\Services\SiswaService;
use App\Services\StatusSiswaService;
use App\Traits\AuditAccess;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UpdateSiswa extends Controller
{
    use AuditAccess;
    private $moduleName = 'Siswa - Update';

    public function __construct(
        private SiswaService $siswaService,
        private StatusSiswaService $statusSiswaService
    )
    {}

    /**
     * Digunakan untuk menampilkan
     * @param string $uuid
     * @return Factory|View|\Illuminate\View\View
     */
    public function index(string $uuid)
    {
        $dataSiswa = $this->siswaService->findDataSiswaByUUID($uuid);
        $listStatusSiswa = $this->statusSiswaService->getAllStatus();
        return view('modules.siswa.update', compact('dataSiswa','listStatusSiswa'));
    }

    /**
     * @param UpdateRequest $request
     * @return RedirectResponse|void
     * @throws \Throwable
     */
    public function onSubmit(UpdateRequest $request)
    {
        $dataSiswa = $this->siswaService->findDataSiswaByUUID($request->post('uuid-siswa'));
        $dataStatusSiswa = $this->statusSiswaService->findByUUID($request->post('status-siswa'));
        $arrayRequest = [
            'id_ref_status_siswa' => $dataStatusSiswa->id,
            'nisn' => $request->post('nisn'),
            'nomor_induk' => $request->post('nomor-induk'),
            'nama_lengkap' => $request->post('nama-lengkap'),
            'gender' => $request->post('gender'),
        ];

        try
        {
            $this->siswaService->updateRecordSiswa($arrayRequest, $dataSiswa->id);
            return response()
                ->redirectToRoute('siswa.index')
                ->with('success', 'Berhasil mengupdate data siswa');
        }
        catch (BusinessException $exception)
        {
            return response()
                ->redirectToRoute('siswa.update', ['uuid' => $dataSiswa->uuid])
                ->with('error', $exception->getMessage());
        }
    }
}