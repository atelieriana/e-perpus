<?php

namespace App\Services;

use App\Interfaces\Transactions\PenempatanSiswaInterface;

readonly class PenempatanSiswaService
{
    public function __construct(
        private PenempatanSiswaInterface $penempatanSiswaInterface,
    )
    {}

    public function getListPenempatanSiswa(array $param)
    {
        return $this->penempatanSiswaInterface->listPenempatanSiswa($param);
    }

    public function createRecordPenempatanSiswa(array $requestData)
    {
        return $this->penempatanSiswaInterface->create($requestData);
    }

    public function deleteRecordPenempatanSiswa(string $uuid)
    {
        $dataPenempatan = $this->penempatanSiswaInterface->findByUuid($uuid);
        return $this->penempatanSiswaInterface->delete($dataPenempatan->id);
    }
}