<?php

namespace App\Services;

use App\Interfaces\References\KodeKelasInterface;

class KodeKelasService
{
    public function __construct(
        private KodeKelasInterface $kodeKelasInterface,
    )
    {}

    public function getDatatablesKodeKelas(int $start, int $end, string $search)
    {
        return $this->kodeKelasInterface->dtKodeKelas($start, $end, $search);
    }

    public function createRecordKodeKelas(array $requestData)
    {
        return $this->kodeKelasInterface->create($requestData);
    }

    public function updateRecordKodeKelas(array $requestData, int $id)
    {
        return $this->kodeKelasInterface->update($requestData, $id);
    }

    public function deleteRecordKodeKelas(int $id)
    {
        return $this->kodeKelasInterface->delete($id);
    }
}