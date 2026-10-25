<?php

namespace App\Http\Controllers\Modules\PeminjamanBukuPelajaran;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Services\BukuPaketService;
use App\Services\KejuruanService;
use App\Services\KelasService;
use App\Services\KodeKelasService;
use App\Services\PeminjamanBukuPelajaranService;
use App\Services\PenempatanSiswaService;
use App\Services\StatusPeminjamanService;
use App\Services\TahunAjarServices;
use Illuminate\Http\Request;

class CreatePeminjamanBukuPelajaran extends Controller
{
    public function __construct(
        private KelasService $kelasService,
        private KejuruanService $kejuruanService,
        private TahunAjarServices $tahunAjarService,
        private PenempatanSiswaService $penempatanSiswaService,
        private BukuPaketService $bukuPaketService,
        private KodeKelasService $kodeKelasService,
        private StatusPeminjamanService $statusPeminjamanService,
        private PeminjamanBukuPelajaranService $peminjamanBukuPelajaranService,
    )
    {}

    public function index(Request $request)
    {
        $listKelas = $this->kelasService->getAllRecord();
        $listKejuruan = $this->kejuruanService->getAllRecord();
        $listTahunAjar = $this->tahunAjarService->getAllRecord();
        $listSiswa = $this->penempatanSiswaService->getSiswaByKodeKelasDanTahunAjar($request->input('uuid-ref-kode-kelas'), $request->input('uuid-ref-tahun-ajar'));
        $listBukuPaket = $this->bukuPaketService->findBukuByKelasDanJurusan($request->input('uuid-ref-kelas'), $request->input('uuid-ref-kejuruan'));
        $listStatusPeminjaman = $this->statusPeminjamanService->getAllRecord();
        $dataKelas = $this->kelasService->findByUUID($request->input('uuid-ref-kelas'));
        $dataKejuruan = $this->kejuruanService->findByUUID($request->input('uuid-ref-kejuruan'));
        $listKodeKelas = $this->kodeKelasService->getKodeKelasByKelasAndKejuruan($dataKelas->id, $dataKejuruan->id);
        return view('modules.peminjaman-buku-pelajaran.create', compact(
            'listKelas',
            'listKejuruan',
            'listTahunAjar',
            'listSiswa',
            'listBukuPaket',
            'listKodeKelas',
            'listStatusPeminjaman'
        ));
    }

    public function onSubmit(Request $request)
    {
        try
        {
            $this->peminjamanBukuPelajaranService->createRecord($request->post('buku-paket'));
            return response()
                ->redirectToRoute('peminjaman-buku-pelajaran.index')
                ->with('success','Data peminjaman buku pelajaran berhasil ditambahkan.');

        }
        catch (BusinessException $exception)
        {
            return response()
                ->redirectToRoute('peminjaman-buku-pelajaran.create', [
                    'uuid-ref-kelas' => $request->input('uuid-ref-kelas'),
                    'uuid-ref-kode-kelas' => $request->input('uuid-ref-kode-kelas'),
                    'uuid-ref-tahun-ajar' => $request->input('uuid-ref-tahun-ajar'),
                    'uuid-ref-kejuruan' => $request->input('uuid-ref-kejuruan'),
                ])
                ->with('error', $exception->getMessage())
                ->withInput();
        }
    }
}
