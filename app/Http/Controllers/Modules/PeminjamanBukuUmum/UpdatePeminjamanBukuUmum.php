<?php

namespace App\Http\Controllers\Modules\PeminjamanBukuUmum;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Requests\PeminjamanBukuUmum\UpdateRequest;
use App\Services\PeminjamanBukuUmumService;
use App\Services\SiswaService;
use App\Services\StatusPeminjamanService;

class UpdatePeminjamanBukuUmum extends Controller
{
    public function __construct(
        private SiswaService $siswaService,
        private PeminjamanBukuUmumService $peminjamanBukuUmumService,
        private StatusPeminjamanService $statusPeminjamanService
    )
    {}

    public function index(string $uuidSiswa, string $tanggalPinjam)
    {
        $dataSiswa = $this->siswaService->findDataSiswaByUUID($uuidSiswa);
        $tanggalPinjam = base64_decode($tanggalPinjam);
        $dataPeminjaman = $this->peminjamanBukuUmumService->getPeminjamanBukuUmumByIdSiswaDanTanggalPinjam($dataSiswa->id, $tanggalPinjam);
        $listStatusPeminjaman = $this->statusPeminjamanService->getAllRecord();
        return view('modules.peminjaman-buku-umum.update', compact('dataPeminjaman','listStatusPeminjaman'));
    }

    public function onSubmit(UpdateRequest $request)
    {
        try
        {
            $this->peminjamanBukuUmumService->updateRecord($request->validated());
            return response()
                ->redirectToRoute('peminjaman-buku-umum.index')
                ->with('success', 'Peminjaman Buku Umum berhasil diupdate');
        }
        catch (BusinessException $exception)
        {
            return response()
                ->redirectToRoute('peminjaman-buku-umum.update', ['uuid' => $request->post('uuid-ref-siswa'), 'tanggal_pinjam' => $request->post('unique-code')])
                ->withErrors($exception->getMessage());
        }
    }
}
