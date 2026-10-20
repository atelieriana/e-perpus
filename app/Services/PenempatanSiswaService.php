<?php

namespace App\Services;

use App\Interfaces\Transactions\PenempatanSiswaInterface;

readonly class PenempatanSiswaService
{
    public function __construct(
        private PenempatanSiswaInterface $penempatanSiswaInterface,
    )
    {}

    public function getDatatablesPenempatanSiswa(array $param, int $start = null, $length = null, $search = null)
    {
        return $this->penempatanSiswaInterface->dtPenempatanSiswa($param, $start, $length, $search);
    }
}