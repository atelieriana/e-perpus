<?php

namespace App\Services;

use App\Interfaces\References\RefTahunAjarInterface;
use App\Interfaces\Transactions\PenempatanSiswaInterface;

readonly class PenempatanSiswaService
{
    public function __construct(
        private PenempatanSiswaInterface $penempatanSiswaInterface,
        private RefTahunAjarInterface $refTahunAjarInterface
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

    public function getSiswaKelasXII(string $uuidTahunAjar = null)
    {
        $dataTahunAjar = $this->refTahunAjarInterface->findByUuid($uuidTahunAjar);
        if ($uuidTahunAjar === null) {
            return $this->penempatanSiswaInterface->getSiswaKelasXII();
        }
        else
        {
            return $this->penempatanSiswaInterface->getSiswaKelasXII($dataTahunAjar->id);
        }
    }
}