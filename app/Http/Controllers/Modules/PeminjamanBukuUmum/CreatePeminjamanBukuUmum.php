<?php

namespace App\Http\Controllers\Modules\PeminjamanBukuUmum;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Requests\PeminjamanBukuUmum\CreateRequest;
use App\Services\BukuService;
use App\Services\KejuruanService;
use App\Services\KelasService;
use App\Services\KodeKelasService;
use App\Services\PeminjamanBukuUmumService;
use App\Services\SiswaService;

class CreatePeminjamanBukuUmum extends Controller
{
    const JENIS_BUKU_UMUM = 1;

    public function __construct(
        private KelasService $kelasService,
        private KejuruanService $kejuruanService,
        private BukuService $bukuService,
        private KodeKelasService $kodeKelasService,
        private SiswaService $siswaService,
        private PeminjamanBukuUmumService $peminjamanBukuUmumService
    )
    {}

    public function index()
    {
        $listKelas = $this->kelasService->getAllRecord();
        $listKejuruan = $this->kejuruanService->getAllRecord();
        $listBuku = $this->bukuService->getBukuByJenisBuku(self::JENIS_BUKU_UMUM);
        $listKodeKelas = null;
        $listSiswa = null;
        if (old('uuid-ref-kode-kelas'))
        {
            $dataKelas = $this->kelasService->findByUUID(old('uuid-ref-kelas'));
            $dataKejuruan = $this->kejuruanService->findByUuid(old('uuid-ref-kejuruan'));
            $listKodeKelas = $this->kodeKelasService->getKodeKelasByKelasAndKejuruan($dataKelas->id, $dataKejuruan->id);
        }
        if (old('uuid-ref-siswa'))
        {
            $listSiswa = $this->siswaService->getSiswaByKelasDanKodeKejuruan(old('uuid-ref-kelas'), old('uuid-ref-kejuruan'));
        }
        return view('modules.peminjaman-buku-umum.create', compact('listKelas', 'listKejuruan', 'listBuku','listKodeKelas','listSiswa'));
    }

    public function onSubmit(CreateRequest $request)
    {
        try
        {
            $this->peminjamanBukuUmumService->createRecord($request->validated());
            return response()
                ->redirectToRoute('peminjaman-buku-umum.index')
                ->with('success', 'Peminjaman Buku Umum berhasil ditambahkan.');
        }
        catch (BusinessException $exception)
        {
            return response()
                ->redirectToRoute('peminjaman-buku-umum.create')
                ->withErrors($exception->getMessage());
        }
    }
}
