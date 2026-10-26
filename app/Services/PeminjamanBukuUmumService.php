<?php

namespace App\Services;

use App\Exceptions\BusinessException;
use App\Interfaces\References\RefBukuInterface;
use App\Interfaces\References\RefSiswaInterface;
use App\Interfaces\Transactions\PeminjamanBukuInterface;
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

    public function getPeminjamanBukuUmumByIdSiswaDanTanggalPinjam(int $idSiswa, string $tanggalPinjam)
    {
        return $this->peminjamanBukuInterface->getPeminjamanBySiswaDanTanggalPinjam($idSiswa, $tanggalPinjam);
    }
}