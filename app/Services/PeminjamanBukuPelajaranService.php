<?php

namespace App\Services;

use App\Exceptions\BusinessException;
use App\Interfaces\References\RefBukuInterface;
use App\Interfaces\References\RefStatusPeminjamanInterface;
use App\Interfaces\References\RefTahunAjarInterface;
use App\Interfaces\Transactions\PeminjamanBukuServiceInterface;
use App\Interfaces\Transactions\PenempatanSiswaInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PeminjamanBukuPelajaranService
{
    const ID_REF_JENIS_PEMINJAMAN_BUKU_PELAJARAN = 1;
    public function __construct(
        private RefStatusPeminjamanInterface $refStatusPeminjaman,
        private RefBukuInterface $refBukuInterface,
        private PenempatanSiswaInterface $penempatanSiswaInterface,
        private PeminjamanBukuServiceInterface $peminjamanBukuServiceInterface,
        private RefTahunAjarInterface $tahunAjarInterface,
    )
    {}

    public function createRecord(array $requestData)
    {
        $arrayData = [];
        $dataTahunAjar = $this->tahunAjarInterface->getCurrentTahunAjar();
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
                            'id_trans_penempatan_siswa' => $this->penempatanSiswaInterface->findByUUID($uuidPenempatanSiswa)->id,
                            'id_ref_buku' => $this->refBukuInterface->findByUUID($uuidBukuPaket)->id,
                            'id_ref_status_peminjaman' => $this->refStatusPeminjaman->findByUUID($uuidStatusPeminjaman)->id,
                            'tangga_mulai_pinjam' => $dataTahunAjar->tanggal_mulai,
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
                $this->peminjamanBukuServiceInterface->create($data);
            }
        }
        catch (QueryException $exception)
        {
            Log::error($exception->getMessage());
            throw new BusinessException('Terjadi kesalahan saat menyimpan data.');
        }
    }
}