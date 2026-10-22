<?php

namespace App\Services;

use App\Interfaces\References\RefKodeKelasInterface;
use App\Models\References\RefKodeKelas;

readonly class KodeKelasService
{
    public function __construct(
        private RefKodeKelasInterface $kodeKelasInterface,
    )
    {}

    /**
     * @param string $uuid
     * @return RefKodeKelas|mixed|null
     */
    public function findByUUID(string $uuid)
    {
        return $this->kodeKelasInterface->findByUUID($uuid);
    }

    /**
     * @param int $idRefKelas
     * @return mixed
     */
    public function getKodeKelasByKelasAndKejuruan(int $idRefKelas, int $idKejuruan)
    {
        return $this->kodeKelasInterface->getKodeKelasByKelasAndKejuruan($idRefKelas, $idKejuruan);
    }

    /**
     * @param int|null $start
     * @param int|null $end
     * @param string|null $search
     * @return mixed
     */
    public function getDatatablesKodeKelas(int $start = null, int $end = null, string $search = null)
    {
        return $this->kodeKelasInterface->dtKodeKelas($start, $end, $search);
    }

    /**
     * @param array $requestData
     * @return mixed
     */
    public function createRecordKodeKelas(array $requestData)
    {
        return $this->kodeKelasInterface->create($requestData);
    }

    /**
     * @param array $requestData
     * @param int $id
     * @return mixed
     */
    public function updateRecordKodeKelas(array $requestData, int $id)
    {
        return $this->kodeKelasInterface->update($requestData, $id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function deleteRecordKodeKelas(int $id)
    {
        return $this->kodeKelasInterface->delete($id);
    }
}