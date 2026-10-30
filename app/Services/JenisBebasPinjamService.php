<?php

namespace App\Services;

use App\Interfaces\References\RefJenisBebasPinjamInterface;

readonly class JenisBebasPinjamService
{
    public function __construct(
        private RefJenisBebasPinjamInterface $refJenisBebasPinjamInterface
    )
    {}

    public function getAllRecord()
    {
        return $this->refJenisBebasPinjamInterface->all();
    }
}