<?php

namespace App\Services;

use App\Exceptions\BusinessException;
use App\Interfaces\References\RefBukuInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
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
     * Digunakan untuk mencari data buku berdasarkan UUID buku
     * @param string $uuid
     * @return mixed
     */
    public function findDataBukuByUUID(string $uuid)
    {
        return $this->refBukuInterface->findByUUID($uuid);
    }

    /**
     * Service yang digunakan untuk menciptakan record buku
     * @param array $requestData
     * @return mixed|void
     * @throws \Throwable\
     */
    public function createRecordBuku(array $requestData)
    {
        try
        {
            return DB::transaction(function () use ($requestData) {
                $this->refBukuInterface->create($requestData);
            });
        }
        catch (QueryException $exception)
        {
            Log::error($exception->getMessage());
            throw new BusinessException("Terjadi kesalahan saat menyimpan data");
        }
    }

    /**
     * Service yang digunakan untuk melakukan update record buku
     * @param array $requestData
     * @param int $id
     * @return void
     * @throws \Throwable
     */
    public function updateRecordBuku(array $requestData, int $id)
    {
        try
        {
            return DB::transaction(function () use ($requestData, $id) {
                $this->refBukuInterface->update($requestData, $id);
            });
        }
        catch (QueryException $exception)
        {
            Log::error($exception->getMessage());
            throw new BusinessException("Terjadi kesalahan saat menyimpan hasil ubah data buku.");
        }
    }

    /**
     * Service yang digunakan untuk menghapus data buku
     * @param int $id
     * @return void
     * @throws \Throwable
     */
    public function deleteRecordBuku(int $id)
    {
        try
        {
            return DB::transaction(function () use ($id) {
                $this->refBukuInterface->delete($id);
            });
        }
        catch (QueryException $exception)
        {
            Log::error($exception->getMessage());
            throw new BusinessException("Terjadi kesalahan saat menghapus data buku.");
        }
    }
}