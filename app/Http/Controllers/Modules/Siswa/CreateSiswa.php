<?php

namespace App\Http\Controllers\Modules\Siswa;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Siswa\CreateRequest;
use App\Services\SiswaService;
use App\Services\StatusSiswaService;
use App\Traits\AuditAccess;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class CreateSiswa extends Controller
{
    use AuditAccess;
    private $moduleName = 'Siswa - Buat';

    public function __construct(
        private SiswaService $siswaService,
        private StatusSiswaService $statusSiswaService,
    )
    {}

    /**
     * Digunakan untuk menampilkan halaman create siswa
     * @return Factory|View|\Illuminate\View\View
     */
    public function index()
    {
        $listStatusSiswa = $this->statusSiswaService->getAllStatus();
        return view('modules.siswa.create', compact('listStatusSiswa'));
    }

    /**
     * Digunakan untuk melakukan submit create siswa
     * @param CreateRequest $request
     * @return RedirectResponse|void
     */
    public function onSubmit(CreateRequest $request)
    {
        $statusSiswa = $this->statusSiswaService->findByUUID($request->post('status-siswa'));
        try
        {
            $arrayRequest = [
                'uuid' => Str::uuid()->toString(),
                'id_ref_status_siswa' => $statusSiswa->id,
                'nomor_induk' => $request->post('nomor-induk'),
                'nisn' => $request->post('nisn'),
                'nama_lengkap' => $request->post('nama-lengkap'),
                'gender' => $request->post('gender')
            ];
            $this->siswaService->createRecordSiswa($arrayRequest);
            return response()
                ->redirectToRoute('siswa.index')
                ->with('success','Data siswa berhasil ditambahkan.');
        }
        catch (BusinessException $exception)
        {
            return response()
                ->redirectToRoute('siswa.create')
                ->with('error', $exception->getMessage());
        }
    }
}