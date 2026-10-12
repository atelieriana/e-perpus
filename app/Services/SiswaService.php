<?php

namespace App\Services;

use App\Exceptions\BusinessException;
use App\Interfaces\References\RefSiswaInterface;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

readonly class SiswaService
{
    public function __construct(
        private RefSiswaInterface $refSiswaInterface,
    )
    {}

    /**
     * Service yang digunakan untuk mendapatkan data siswa untuk datatables
     * @param int|null $start
     * @param $length
     * @param $search
     * @return Collection|mixed
     */
    public function getDatatablesSiswa(int $start = null, $length = null, $search = null)
    {
        return $this->refSiswaInterface->dtSiswa($start, $length, $search);
    }

    /**
     * Service yang digunakan untuk mendapatkan data siswa berdasarkan UUID
     * @param string $uuid
     * @return mixed
     */
    public function findDataSiswaByUUID(string $uuid)
    {
        return $this->refSiswaInterface->findByUUID($uuid);
    }

    /**
     * Service yang digunakan untuk melakukan create data siswa pada database
     * @param array $araryRequest
     * @return RedirectResponse|mixed|null
     * @throws \Throwable
     */
    public function createRecordSiswa(array $araryRequest)
    {
        try
        {
            return DB::transaction(function () use ($araryRequest) {
                return $this->refSiswaInterface->create($araryRequest);
            });
        }
        catch (QueryException $exception)
        {
            Log::error($exception->getMessage());
            throw new BusinessException("Terjadi kesalahan saat menyimpan data siswa");
        }
    }

    /**
     * Service yang digunakan untuk melakukan update data siswa pada database
     * @param array $araryRequest
     * @param int $id
     * @return mixed
     * @throws \Throwable
     */
    public function updateRecordSiswa(array $araryRequest, int $id)
    {
        try
        {
            return DB::transaction(function () use ($araryRequest, $id) {
                return $this->refSiswaInterface->update($araryRequest, $id);
            });
        }
        catch (QueryException $exception)
        {
            Log::error($exception->getMessage());
            throw new BusinessException("Terjadi kesalahan saat mengubah data siswa");
        }
    }

    /**
     * Service yang digunakan untuk melakukan soft delete pada data siswa
     * @param int $id
     * @return mixed
     * @throws \Throwable
     */
    public function deleteRecordSiswa(int $id)
    {
        try
        {
            return DB::transaction(function () use ($id) {
                return $this->refSiswaInterface->delete($id);
            });
        }
        catch (QueryException $exception)
        {
            Log::error($exception->getMessage());
            throw new BusinessException("Terjadi kesalahan saat menghapus data siswa");
        }
    }
}