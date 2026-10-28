<?php

namespace App\Services;

use App\Exceptions\BusinessException;
use App\Interfaces\References\RefBukuInterface;
use App\Interfaces\References\RefSiswaInterface;
use App\Interfaces\Transactions\HibahBukuInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

readonly class HibahBukuService
{
    const JENIS_BUKU_UMUM = 1;
    public function __construct(
        private RefSiswaInterface $refSiswaInterface,
        private RefBukuInterface $refBukuInterface,
        private HibahBukuInterface $hibahBukuInterface
    )
    {}

    public function getDatatablesHibahBuku(int $start = null, $length = null, $search = null)
    {
        return $this->hibahBukuInterface->dtHibahBuku($start, $length, $search);
    }

    public function createRecordHibahBuku(array $requestData)
    {
        $dataSiswa = $this->refSiswaInterface->findByUUID($requestData['uuid-ref-siswa']);
        $dataBuku = [
            'uuid' => Str::uuid()->toString(),
            'judul' => $requestData['judul'],
            'kota_terbit' => $requestData['kota-terbit'],
            'penerbit' => $requestData['penerbit'],
            'penulis' => $requestData['penulis'],
            'tahun_terbit' => $requestData['tahun-terbit'],
            'isbn' => $requestData['isbn'],
            'halaman' => $requestData['halaman'],
            'deskripsi_fisik' => $requestData['deskripsi-fisik'],
            'jumlah_buku' => $requestData['jumlah-buku'],
            'file_cover' => $requestData['file_cover'],
            'id_ref_jenis_buku' => self::JENIS_BUKU_UMUM
        ];

        $dataHibah = [
            'uuid' => Str::uuid()->toString(),
            'id_ref_siswa' => $dataSiswa->id,
        ];
        try
        {
            return DB::transaction(function () use ($dataBuku, $dataHibah) {
                $dataBuku = $this->refBukuInterface->create($dataBuku);
                $dataHibah['id_ref_buku'] = $dataBuku->id;
                $dataHibah['tanggal_sumbang'] = now()->format('Y-m-d');
                return $this->hibahBukuInterface->create($dataHibah);
            });
        }
        catch (QueryException $exception)
        {
            Log::error($exception->getMessage());
            throw new BusinessException('Terjadi kesalahan saat membuat hibah buku');
        }
    }
}