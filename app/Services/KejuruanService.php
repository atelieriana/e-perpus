<?php

namespace App\Services;

use App\Interfaces\References\RefKejuruanInterface;
use Illuminate\Database\Eloquent\Collection;

readonly class KejuruanService
{
    public function __construct(
        private RefKejuruanInterface $refKejuruanInterface,
    )
    {}


    /**
     * Digunakan untuk mendapatkan seluruh data kejuruan
     * @return Collection
     */
    public function getAllRecord()
    {
        return $this->refKejuruanInterface->all();
    }

    /**
     * Service yang digunakan untuk melakukan pencairan berdasarkan UUID
     * @param string $uuid
     * @return mixed
     */
    public function findByUUID(string $uuid)
    {
        return $this->refKejuruanInterface->findByUUID($uuid);
    }

    /**
     * Service yang digunakan untuk menyediakan service datatables data kejuruan
     * @param int|null $start
     * @param $length
     * @param $search
     * @return mixed
     */
    public function getDatatablesKejuruan(int $start = null, $length = null, $search = null)
    {
        return $this->refKejuruanInterface->dtDataKejuruan($start, $length, $search);
    }

    /**
     * Service yang digunakan untuk melakukan create record kejuruan
     * @param array $requestData
     * @return void
     */
    public function createRecordKejuruan(array $requestData)
    {
        $this->refKejuruanInterface->create($requestData);
    }

    /**
     * Service
     * @param array $requestData
     * @param int $id
     * @return void
     */
    public function updateRecordKejuruan(array $requestData, int $id)
    {
        $this->refKejuruanInterface->update($requestData, $id);
    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteRecordKejuruan(int $id)
    {
        $this->refKejuruanInterface->delete($id);
    }
}