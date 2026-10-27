<?php

namespace App\Services;

use App\Interfaces\References\RefBukuInterface;
use App\Interfaces\References\RefSiswaInterface;
use App\Interfaces\Transactions\HibahBukuInterface;

readonly class HibahBukuService
{
    public function __construct(
        private RefSiswaInterface $refSiswaInterface,
        private RefBukuInterface $refBukuInterface,
        private HibahBukuInterface $hibahBukuInterface
    )
    {}

    public function getDatatablesHibahBuku(int $start = null, $length = null, $search = null)
    {
        return $this->hibahBukuInterface->dtHibahBuku($start, $length, $search);
    }
}