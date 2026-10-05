<?php

namespace App\Services;

use App\Interfaces\References\RefBukuInterface;

readonly class BukuService
{
    const BUKU_PELAJARAN = 2;
    const BUKU_UMUM = 1;
    public function __construct(
        private RefBukuInterface $refBukuInterface
    )
    {}

    public function getDatatablesBukuPelajaran(int $start = null, int $end = null)
    {
        return $this->refBukuInterface->findDataByIdJenisBuku(self::BUKU_PELAJARAN, $start, $end);
    }

    public function create(array $reuqestData)
    {
//        try
//        {
//
//        }
//        catch (QueryException $exception)
//        {
//            Log::error($exception->getMessage());
//            throw new BusinessException("Terjadi kesalahan saat menyimpan data buku.");
//        }
    }
}