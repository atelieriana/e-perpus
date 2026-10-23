<?php

namespace App\Services;

use App\Interfaces\References\RefSiswaInterface;
use App\Interfaces\References\RefTahunAjarInterface;
use App\Repositories\References\RefSiswaRepository;

readonly class ProsesKelulusanService
{
    public function __construct(
        private RefSiswaInterface $refSiswaInterface,
        private RefTahunAjarInterface $refTahunAjarInterface
    )
    {}

    public function prosesKelulusan(string $uuidTahunAjar)
    {
        $dataTahunAjar = $this->refTahunAjarInterface->findByUUID($uuidTahunAjar);
        $this->refSiswaInterface->massUpdateSiswaLulusByTahunAjar($dataTahunAjar->id);
    }

    public function rollbackProsesKelulusan(string $uuidTahunAjar)
    {
        $dataTahunAjar = $this->refTahunAjarInterface->findByUUID($uuidTahunAjar);
        $this->refSiswaInterface->massRollbackSiswaLulusByTahunAjar($dataTahunAjar->id);
    }
}