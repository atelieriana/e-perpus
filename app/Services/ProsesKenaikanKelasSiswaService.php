<?php

namespace App\Services;

use App\Interfaces\References\RefKelasInterface;
use App\Interfaces\References\RefKodeKelasInterface;
use App\Interfaces\References\RefTahunAjarInterface;
use App\Interfaces\Transactions\PenempatanSiswaInterface;
use App\Interfaces\Views\MappingKelasSebelumDanSelanjutnyaInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

readonly class ProsesKenaikanKelasSiswaService
{
    public function __construct(
        private PenempatanSiswaInterface $penempatanSiswaInterface,
        private RefTahunAjarInterface $refTahunAjarInterface,
        private MappingKelasSebelumDanSelanjutnyaInterface $mappingKelasSebelumDanSelanjutnyaInterface,
        private RefKelasInterface $refKelasInterface
    )
    {}

    public function prosesKenaikanKelasSiswa(string $uuidRefKelas)
    {
        $dataKelas = $this->refKelasInterface->findByUuid($uuidRefKelas);
        $dataTahunAjarSecondLastData = $this->refTahunAjarInterface->getTahunAjarDataSebelumTerakhir();
        $dataTahunAjar = $this->refTahunAjarInterface->getTahunAjarTerakhir();
        $listSiswaMapping = collect($this->penempatanSiswaInterface->getSiswaKelasXOrXI($dataTahunAjarSecondLastData->id,$dataKelas->id));
        $resultMapping = $this->createArrayData($listSiswaMapping, $dataTahunAjar->id);

        foreach ($resultMapping as $mapping) {
            $this->penempatanSiswaInterface->create($mapping);
        }
    }

    private function mappingKodeKelasSelanjutnya()
    {
        $listMappingKelas = collect($this->mappingKelasSebelumDanSelanjutnyaInterface->all());
        return $listMappingKelas->mapWithKeys(fn ($item) => [
            $item->id => (object)[
                'id_ref_kelas_selanjutnya' => $item->id_kelas_selanjutnya,
                'id_ref_kelas_sebelumnya'  => $item->id_kelas_sebelumnya,
            ],
        ]);
    }

    private function createArrayData(object $listSiswa, int $idTahunAjar)
    {
        $mappingKelas = $this->mappingKodeKelasSelanjutnya();
        $collectionSiswa = collect($listSiswa);
        return $collectionSiswa->map(function($siswa) use ($mappingKelas, $idTahunAjar) {
            return [
                'uuid' => Str::uuid()->toString(),
                'id_ref_siswa' => $siswa->id_ref_siswa,
                'id_ref_kode_kelas' => $mappingKelas[$siswa->id_ref_kode_kelas]->id_ref_kelas_selanjutnya,
                'id_ref_tahun_ajar' => $idTahunAjar
            ];
        })->toArray();
    }
}