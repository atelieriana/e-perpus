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

    /**
     * Digunakan untuk menyediakan data buku pelajaran dalam format datatables
     * @param int|null $start
     * @param int|null $end
     * @param string|null $search
     * @return mixed
     */
    public function getDatatablesBukuPelajaran(int $start = null, int $end = null, string $search = null)
    {
        return $this->refBukuInterface->dtDataByIdJenisBuku(self::BUKU_PELAJARAN, $start, $end, $search);
    }

    /**
     * Digunakan untuk menyediakan data buku umum dalam format datatables
     * @param int|null $start
     * @param int|null $end
     * @param string|null $search
     * @return mixed
     */
    public function getDatatablesBukuUmum(int $start = null, int $end = null, string $search = null)
    {
        return $this->refBukuInterface->dtDataByIdJenisBuku(self::BUKU_UMUM, $start, $end);
    }

    /**
     * @param array $requestData
     * @return void
     */
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