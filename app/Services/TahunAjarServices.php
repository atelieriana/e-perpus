<?php

namespace App\Services;

use App\Interfaces\References\RefTahunAjarInterface;

readonly class TahunAjarServices
{
    public function __construct(
        private RefTahunAjarInterface $refTahunAjarInterface,
    )
    {}

    /**
     * Digunakan untuk menyediakan service datatables tahun ajar
     * @param int|null $start
     * @param $length
     * @param $search
     * @return mixed
     */
    public function getDatatablesTahunAjar(int $start = null, $length = null, $search = null)
    {
        return $this->refTahunAjarInterface->dtDataKejuruan($start, $length, $search);
    }

    /**
     * Digunakan untuk membuat record tahun ajar baru
     * @param array $requestData
     * @return mixed
     */
    public function createReccordTahunAjar(array $requestData)
    {
        return $this->refTahunAjarInterface->create($requestData);
    }

    /**
     * Digunakan untuk mengupdate tahun ajar
     * @param array $requestData
     * @param int $id
     * @return mixed
     */
    public function updateReccordTahunAjar(array $requestData, int $id)
    {
        return $this->refTahunAjarInterface->update($requestData, $id);
    }

    /**
     * Digunakan untuk hapus data tahun ajar
     * @param int $id
     * @return mixed
     */
    public function deleteReccordTahunAjar(int $id)
    {
        return $this->refTahunAjarInterface->delete($id);
    }
}