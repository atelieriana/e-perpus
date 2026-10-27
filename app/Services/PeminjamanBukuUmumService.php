<?php

namespace App\Services;

use App\Exceptions\BusinessException;
use App\Interfaces\References\RefBukuInterface;
use App\Interfaces\References\RefSiswaInterface;
use App\Interfaces\References\RefStatusPeminjamanInterface;
use App\Interfaces\Transactions\PeminjamanBukuInterface;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PeminjamanBukuUmumService
{
    const JENIS_PEMINJAMAN_PRIBADI = 2;
    const STATUS_JENIS_PINJMAN_DIPINJAM = 1;

    public function __construct(
        private PeminjamanBukuInterface $peminjamanBukuInterface,
        private RefBukuInterface $refBukuInterface,
        private RefSiswaInterface $refSiswaInterface,
        private RefStatusPeminjamanInterface $refStatusPeminjamanInterface
    )
    {}

    /**
     * @param int|null $start
     * @param int|null $end
     * @param string|null $search
     * @return mixed
     */
    public function getDatatablesPemeinjamanUmum(int $start = null, int $end = null, string $search = null)
    {
        return $this->peminjamanBukuInterface->dtDataPeminjamanBukuUmum($start, $end, $search);
    }

    public function createRecord(array $requestData)
    {
        $dataSiswa = $this->refSiswaInterface->findByUUID($requestData['uuid-ref-siswa']);
        try
        {
            return DB::transaction(function () use ($requestData, $dataSiswa) {
                foreach ($requestData['uuid-ref-buku'] as $uuidRefBuku) {
                    if (!is_null($uuidRefBuku)) {
                        $dataBuku = $this->refBukuInterface->findByUUID($uuidRefBuku);
                        $arrayData = [
                            'uuid' => Str::uuid()->toString(),
                            'id_ref_buku' => $dataBuku->id,
                            'id_ref_siswa' => $dataSiswa->id,
                            'id_ref_jenis_peminjaman' => self::JENIS_PEMINJAMAN_PRIBADI,
                            'id_ref_status_peminjaman' => self::STATUS_JENIS_PINJMAN_DIPINJAM,
                            'tanggal_mulai_pinjam' => $requestData['tanggal-pinjam'],
                            'tanggal_akhir_pinjam' => $requestData['tanggal-terakhir-pinjam'],
                        ];

                        $this->peminjamanBukuInterface->create($arrayData);
                    }
                }
            });
        }
        catch (QueryException $exception)
        {
            Log::error($exception->getMessage());
            throw new BusinessException('Terjadi kesalahan saat penyimpanan data peminjaman buku umum');
        }
    }

    public function updateRecord(array $requestData)
    {
        return DB::transaction(function () use ($requestData) {
            $iteration = 0;
            foreach ($requestData['uuid-trans-peminjaman'] as $uuidTransPeminjaman) {
                $dataPeminjaman = $this->peminjamanBukuInterface->findByUUID($uuidTransPeminjaman);
                $dataStatusPeminjaman = $this->refStatusPeminjamanInterface->findByUUID($requestData['uuid-ref-status-peminjaman'][$iteration]);
                if ($dataStatusPeminjaman->id == 1 && !is_null($requestData['perpanjangan-pinjam'][$iteration]))
                {
                    $arrayData = [
                        'id_ref_status_peminjaman' => $dataStatusPeminjaman->id,
                        'tanggal_akhir_pinjam' => $requestData['perpanjangan-pinjam'][$iteration],
                    ];
                }

                if ($dataStatusPeminjaman->id == 2 || $dataStatusPeminjaman->id === 4)
                {
                    $arrayData = [
                        'id_ref_status_peminjaman' => $dataStatusPeminjaman->id,
                        'tanggal_pengembalian' => now()->format('Y-m-d'),
                    ];
                }

                if ($dataStatusPeminjaman->id == 3)
                {
                    $arrayData = [
                        'id_ref_status_peminjaman' => $dataStatusPeminjaman->id,
                    ];
                }

                $this->peminjamanBukuInterface->update($arrayData, $dataPeminjaman->id);
                $iteration++;
            }
        });
    }

    public function getPeminjamanBukuUmumByIdSiswaDanTanggalPinjam(int $idSiswa, string $tanggalPinjam)
    {
        return $this->peminjamanBukuInterface->getPeminjamanBySiswaDanTanggalPinjam($idSiswa, $tanggalPinjam);
    }
}