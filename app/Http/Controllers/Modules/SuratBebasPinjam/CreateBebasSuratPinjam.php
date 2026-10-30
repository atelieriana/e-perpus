<?php

namespace App\Http\Controllers\Modules\SuratBebasPinjam;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuratBebasPinjam\CreateRequest;
use App\Services\HistoryPeminjamanService;
use App\Services\JenisBebasPinjamService;
use App\Services\KejuruanService;
use App\Services\KelasService;
use App\Services\KodeKelasService;
use App\Services\SiswaService;
use App\Services\TahunAjarServices;

class CreateBebasSuratPinjam extends Controller
{
    public function __construct(
        private KelasService $kelasService,
        private KejuruanService $kejuruanService,
        private TahunAjarServices $tahunAjarService,
        private JenisBebasPinjamService $jenisBebasPinjamService,
        private HistoryPeminjamanService $historyPeminjamanService,
        private KodeKelasService $kodeKelasService,
        private SiswaService $siswaService,
    )
    {}

    public function index()
    {
        $listKelas = $this->kelasService->getAllRecord();
        $listKejuruan = $this->kejuruanService->getAllRecord();
        $listTahunAjar = $this->tahunAjarService->getAllRecord();
        $listJenisBebasPinjam = $this->jenisBebasPinjamService->getAllRecord();
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
            $listSiswa = $this->siswaService->getSiswaByKelasKejuruanDanTahunAjar(old('uuid-ref-kelas'), old('uuid-ref-kejuruan'), old('uuid-ref-tahun-ajar'));
        }
        return view('modules.surat-bebas-pinjam.create', compact('listKelas', 'listKejuruan', 'listTahunAjar','listJenisBebasPinjam','listKodeKelas','listSiswa'));
    }

    public function onSubmit(CreateRequest $request)
    {
        try
        {
            $this->historyPeminjamanService->createRecord($request->validated());
            return response()
                ->redirectToRoute('surat-bebas-pinjam.index')
                ->with('success','Surat bebas pinjam berhasil ditambahkan.');
        }
        catch (BusinessException $exception)
        {
            return response()
                ->redirectToRoute('surat-bebas-pinjam.create')
                ->with('error', $exception->getMessage())
                ->withInput();
        }
    }
}
