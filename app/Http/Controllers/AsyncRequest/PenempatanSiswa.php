<?php

namespace App\Http\Controllers\AsyncRequest;

use App\Http\Controllers\Controller;
use App\Services\KodeKelasService;
use App\Services\PenempatanSiswaService;
use App\Services\SiswaService;
use App\Services\TahunAjarServices;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PenempatanSiswa extends Controller
{
    public function __construct(
        private PenempatanSiswaService $penempatanSiswaService,
        private SiswaService $siswaService,
        private KodeKelasService $kodeKelasService,
        private TahunAjarServices $tahunAjarService,
    )
    {}

    public function listPenempatanSiswa(Request $request)
    {
        $requestData = [
            'uuid-ref-kelas' => $request->post('uuid-ref-kelas'),
            'uuid-ref-kode-kelas' => $request->post('uuid-ref-kode-kelas'),
            'uuid-ref-tahun-ajar' => $request->post('uuid-ref-tahun-ajar'),
        ];

        return $this->penempatanSiswaService->getListPenempatanSiswa($requestData);
    }

    public function listSiswaTanpaKelas(Request $request)
    {
        return $this->siswaService->getSiswaTanpaKelas($request->post('uuid-ref-tahun-ajar'));
    }

    public function hapusSiswaDariKelas(Request $request)
    {
        return $this->penempatanSiswaService->deleteRecordPenempatanSiswa($request->post('uuid-trans-penempatan-siswa'));
    }

    public function tambahSiswaKeKelas(Request $request)
    {
        $dataSiswa = $this->siswaService->findDataSiswaByUUID($request->post('uuid-ref-siswa'));
        $dataKodeKelas = $this->kodeKelasService->findByUUID($request->post('uuid-ref-kode-kelas'));
        $dataTahunAjar = $this->tahunAjarService->findByUUID($request->post('uuid-ref-tahun-ajar'));
        $requestData = [
            'uuid' => Str::uuid()->toString(),
            'id_ref_siswa' => $dataSiswa->id,
            'id_ref_kode_kelas' => $dataKodeKelas->id,
            'id_ref_tahun_ajar' => $dataTahunAjar->id,
        ];
        return $this->penempatanSiswaService->createRecordPenempatanSiswa($requestData);
    }
}