<?php

namespace App\Services;

use App\Interfaces\References\RefStatusPeminjamanInterface;

class StatusPeminjamanService
{
    public function __construct(
        private RefStatusPeminjamanInterface $refStatusPeminjamanInterface
    )
    {}

    public function getAllRecord()
    {
        return $this->refStatusPeminjamanInterface->all();
    }
}