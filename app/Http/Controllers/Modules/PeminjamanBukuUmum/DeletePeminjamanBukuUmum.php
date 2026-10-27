<?php

namespace App\Http\Controllers\Modules\PeminjamanBukuUmum;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Requests\PeminjamanBukuUmum\DeleteRequest;
use App\Services\PeminjamanBukuUmumService;
use App\Services\SiswaService;

class DeletePeminjamanBukuUmum extends Controller
{
    public function __construct(
        private SiswaService $siswaService,
        private PeminjamanBukuUmumService $peminjamanBukuUmumService,
    )
    {}

    public function index(string $uuidSiswa, string $tanggalPinjam)
    {
        $dataSiswa = $this->siswaService->findDataSiswaByUUID($uuidSiswa);
        $tanggalPinjam = base64_decode($tanggalPinjam);
        $dataPeminjaman = $this->peminjamanBukuUmumService->getPeminjamanBukuUmumByIdSiswaDanTanggalPinjam($dataSiswa->id, $tanggalPinjam);
        return view('modules.peminjaman-buku-umum.delete', compact('dataPeminjaman','dataPeminjaman'));
    }

    public function onSubmit(DeleteRequest $request)
    {
        try
        {
            $this->peminjamanBukuUmumService->deleteRecord($request->validated());
            return redirect()
                ->route('peminjaman-buku-umum.index')
                ->with('success','Peminjaman Buku Umum berhasil dihapus');
        }
        catch (BusinessException $exception)
        {
            return response()
                ->redirectToRoute('peminjaman-buku-umum.delete', ['uuid' => $request->uuid, 'tanggalPinjam' => $request->tanggalPinjam])
                ->with('error', $exception->getMessage());
        }
    }
}
