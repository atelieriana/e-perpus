<?php

namespace App\Http\Controllers\Modules\SuratBebasPinjam;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuratBebasPinjam\UpdateRequest;
use App\Services\SiswaService;
use App\Services\SuratBebasPinjamService;

class UpdateBebasSuratPinjam extends Controller
{
    public function __construct(
        private SiswaService $siswaService,
        private SuratBebasPinjamService $suratBebasPinjamService
    )
    {}

    public function index(string $uuid)
    {
        $dataSuratBebasPinjam = $this->suratBebasPinjamService->findByUUID($uuid);
        $dataSiswa = $this->siswaService->findById($dataSuratBebasPinjam->id_ref_siswa);
        return view('modules.surat-bebas-pinjam.update',compact('dataSuratBebasPinjam','dataSiswa'));
    }

    public function onSubmit(UpdateRequest $request)
    {
        try
        {
            $this->suratBebasPinjamService->updateRecord($request->validated());
            return response()
                ->redirectToRoute('surat-bebas-pinjam.index')
                ->with('success','Perubahan berhasil disimpan.');
        }
        catch (BusinessException $exception)
        {
            return response()
                ->redirectToRoute('surat-bebas-pinjam.update',['uuid' => $request->post('uuid-trans-surat-bebas-pinjam')])
                ->with('error', $exception->getMessage())
                ->withInput();
        }
    }
}
