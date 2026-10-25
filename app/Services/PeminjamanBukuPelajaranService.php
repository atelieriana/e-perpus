<?php

namespace App\Services;

use App\Exceptions\BusinessException;
use App\Interfaces\References\RefBukuInterface;
use App\Interfaces\References\RefKodeKelasInterface;
use App\Interfaces\References\RefSiswaInterface;
use App\Interfaces\References\RefStatusPeminjamanInterface;
use App\Interfaces\References\RefTahunAjarInterface;
use App\Interfaces\Transactions\PeminjamanBukuServiceInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

readonly class PeminjamanBukuPelajaranService
{
    const ID_REF_JENIS_PEMINJAMAN_BUKU_PELAJARAN = 1;
    public function __construct(
        private RefStatusPeminjamanInterface $refStatusPeminjaman,
        private RefBukuInterface $refBukuInterface,
        private RefSiswaInterface $refSiswaInterface,
        private PeminjamanBukuServiceInterface $peminjamanBukuServiceInterface,
        private RefTahunAjarInterface $tahunAjarInterface,
        private RefKodeKelasInterface $refKodeKelasInterface,
    )
    {}

    public function getRecordByKodeKelasAndTahunAjar(string $uuidRefKodeKelas, string $uuidRefTahunAjar)
    {
        $dataKodeKelas = $this->refKodeKelasInterface->findByUuid($uuidRefKodeKelas);
        $dataTahunAjar = $this->tahunAjarInterface->findByUuid($uuidRefTahunAjar);
        $listPeminjaman = $this->peminjamanBukuServiceInterface->getPeminjamanBukuByKodeKelasDanTahun($dataKodeKelas->id, $dataTahunAjar->id);
        $arrayData = [];
        foreach ($listPeminjaman as $peminjaman) {
            $array = [
                $peminjaman->uuid_ref_siswa => (object)[
                    $peminjaman->uuid_ref_buku => (object)[
                        $peminjaman->uuid_ref_status_peminjaman
                    ]
                ]
            ];
            array_push($arrayData, $array);
        }

        return $arrayData;
    }

    public function createRecord(array $requestData, string $uuidTahunAjar)
    {
        $arrayData = [];
        $dataTahunAjar = $this->tahunAjarInterface->findByUuid($uuidTahunAjar);
        foreach ($requestData as $uuidPenempatanSiswa => $listBukuPaket)
        {
            foreach ($listBukuPaket as $uuidBukuPaket => $listStatusPeminjaman)
            {
                foreach ($listStatusPeminjaman as $uuidStatusPeminjaman)
                {
                    if (!is_null($uuidStatusPeminjaman))
                    {
                        $array = [
                            'uuid' => Str::uuid()->toString(),
                            'id_ref_jenis_peminjaman' => self::ID_REF_JENIS_PEMINJAMAN_BUKU_PELAJARAN,
                            'id_ref_siswa' => $this->refSiswaInterface->findByUUID($uuidPenempatanSiswa)->id,
                            'id_ref_buku' => $this->refBukuInterface->findByUUID($uuidBukuPaket)->id,
                            'id_ref_status_peminjaman' => $this->refStatusPeminjaman->findByUUID($uuidStatusPeminjaman)->id,
                            'tanggal_mulai_pinjam' => $dataTahunAjar->tanggal_mulai,
                            'tanggal_akhir_pinjam' => $dataTahunAjar->tanggal_akhir,
                        ];
                        array_push($arrayData, $array);
                    }
                }
            }
        }

        try
        {
            foreach ($arrayData as $data)
            {
                $this->peminjamanBukuServiceInterface->massUpsert($data);
            }
        }
        catch (QueryException $exception)
        {
            Log::error($exception->getMessage());
            throw new BusinessException('Terjadi kesalahan saat menyimpan data.');
        }
    }
}