<?php

namespace App\Http\Controllers\Modules\SuratBebasPinjam;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuratBebasPinjam\DeleteRequest;
use App\Services\SiswaService;
use App\Services\SuratBebasPinjamService;

class DeleteBebasSuratPinjam extends Controller
{
    public function __construct(
        private SuratBebasPinjamService $suratBebasPinjamService,
        private SiswaService $siswaService,
    )
    {}

    public function index(string $uuid)
    {
        $dataSuratBebasPinjam = $this->suratBebasPinjamService->findByUUID($uuid);
        $dataSiswa = $this->siswaService->findById($dataSuratBebasPinjam->id_ref_siswa);
        return view('modules.surat-bebas-pinjam.delete', compact('dataSuratBebasPinjam','dataSiswa'));
    }

    public function onSubmit(DeleteRequest $request)
    {
        try
        {
            $this->suratBebasPinjamService->deleteRecord($request->validated());
            return response()
                ->redirectToRoute('surat-bebas-pinjam.index')
                ->with('success','Berhasil menghapus surat bebas pinjam.');
        }
        catch (BusinessException $exception)
        {
            return response()
                ->redirectToRoute('surat-bebas-pinjam.delete',['uuid' => $request->post('uuid-ref-surat-bebas-pinjam')])
                ->with('error', $exception->getMessage());
        }
    }
}
