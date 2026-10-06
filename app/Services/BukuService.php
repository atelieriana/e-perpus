<?php

namespace App\Services;

use App\Exceptions\BusinessException;
use App\Interfaces\References\RefBukuInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

readonly class BukuService
{
    const BUKU_PELAJARAN = 2;
    const BUKU_UMUM = 1;
    public function __construct(
        private RefBukuInterface $refBukuInterface
    )
    {}

    public function getDatatablesBukuPelajaran(int $start = null, int $end = null, string $search = null)
    {
        return $this->refBukuInterface->dtDataByIdJenisBuku(self::BUKU_PELAJARAN, $start, $end, $search);
    }

    public function getDatatablesBukuUmum(int $start = null, int $end = null, string $search = null)
    {
        return $this->refBukuInterface->dtDataByIdJenisBuku(self::BUKU_UMUM, $start, $end);
    }

    public function createRecordBuku(array $requestData)
    {
        try
        {
            $this->refBukuInterface->create($requestData);
        }
        catch (QueryException $exception)
        {
            Log::error($exception->getMessage());
            throw new BusinessException("Terjadi kesalahan saat menyimpan data buku.");
        }
    }
}