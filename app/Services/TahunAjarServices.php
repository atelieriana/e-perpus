<?php

namespace App\Services;

use App\Interfaces\References\RefTahunAjarInterface;

readonly class TahunAjarServices
{
    public function __construct(
        private RefTahunAjarInterface $refTahunAjarInterface,
    )
    {}

    public function getDatatablesTahunAjar(int $start = null, $length = null, $search = null)
    {
        return $this->refTahunAjarInterface->dtDataKejuruan($start, $length, $search);
    }

    public function createReccordTahunAjar(array $requestData)
    {

    }

    public function updateReccordTahunAjar(array $requestData, int $id)
    {

    }

    public function deleteReccordTahunAjar(int $id)
    {

    }
}