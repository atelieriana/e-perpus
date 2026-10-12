<?php

namespace App\Services;

use App\Interfaces\References\RefStatusSiswaInterface;
use Illuminate\Database\Eloquent\Collection;

readonly class StatusSiswaService
{
    public function __construct(
        private RefStatusSiswaInterface $refStatusSiswa
    )
    {}

    /**
     * @return Collection
     */
    public function getAllStatus()
    {
        return $this->refStatusSiswa->all();
    }

    public function findByUUID(string $uuid)
    {
        return $this->refStatusSiswa->findByUUID($uuid);
    }
}