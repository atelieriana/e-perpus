<?php

namespace App\Services;

use App\Exceptions\BusinessException;
use App\Interfaces\References\RefBukuPaketInterface;
use App\Interfaces\References\RefKejuruanInterface;
use App\Interfaces\References\RefKelasInterface;
use App\Interfaces\References\RefTahunAjarInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

readonly class BukuPaketService
{
    public function __construct(
        private RefBukuPaketInterface $refBukuPaketInterface,
        private RefKelasInterface $refKelasInterface,
        private RefKejuruanInterface $refKejuruanInterface,
    )
    {}

    /**
     * @param string $uuid
     * @return mixed
     */
    public function findByUUID(string $uuid)
    {
        return $this->refBukuPaketInterface->findByUUID($uuid);
    }

    /**
     * @param string $uuidRefKelas
     * @param string $uuidRefKejuruan
     * @return mixed
     */
    public function findBukuByKelasDanJurusan(string $uuidRefKelas, string $uuidRefKejuruan)
    {
        $dataKelas = $this->refKelasInterface->findByUUID($uuidRefKelas);
        $dataKejuruan = $this->refKejuruanInterface->findByUuid($uuidRefKejuruan);
        return $this->refBukuPaketInterface->getByIdKelasDanKejuruan($dataKelas->id, $dataKejuruan->id);
    }

    /**
     * @param array $requestData
     * @return mixed|void
     * @throws Throwable
     */
    public function createRecordBukuPaket(array $requestData)
    {
        try
        {
            return DB::transaction(function () use ($requestData) {
                $this->refBukuPaketInterface->create($requestData);
            });
        }
        catch (QueryException $exception)
        {
            Log::error($exception->getMessage());
            throw new BusinessException("Terjadi kesalahan saat melakukan create buku paket");
        }
    }

    /**
     * @param array $requestData
     * @param int $id
     * @return mixed|void
     * @throws Throwable
     */
    public function updateRecordBukuPaket(array $requestData, int $id)
    {
        try
        {
            return  DB::transaction(function () use ($requestData, $id) {
                $this->refBukuPaketInterface->update($requestData, $id);
            });
        }
        catch (QueryException $exception)
        {
            Log::error($exception->getMessage());
            throw new BusinessException("Terjadi kesalahan saat melakukan update buku paket");
        }
    }

    /**
     * @param int $id
     * @return mixed|void
     * @throws Throwable
     */
    public function deleteRecordBukuPaket(int $id)
    {
        try
        {
            return DB::transaction(function () use ($id) {
                $this->refBukuPaketInterface->delete($id);
            });
        }
        catch (QueryException $exception)
        {
            Log::error($exception->getMessage());
            throw new BusinessException("Terjadi kesalahan saat menghapus buku paket");
        }
    }
}