<?php

namespace App\Services;

use App\Interfaces\References\RefKelasInterface;

readonly class KelasService
{
    public function __construct(
        private RefKelasInterface $refKelasInterface
    )
    {}

    public function getAllRecord()
    {
        return $this->refKelasInterface->all();
    }

    public function findByUUID(string $uuid)
    {
        return $this->refKelasInterface->findByUUID($uuid);
    }
}