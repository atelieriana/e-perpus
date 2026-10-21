<?php

namespace App\Services;

use App\Interfaces\Transactions\PenempatanSiswaInterface;

readonly class PenempatanSiswaService
{
    public function __construct(
        private PenempatanSiswaInterface $penempatanSiswaInterface,
    )
    {}

    public function getListPenempatanSiswa(array $param)
    {
        return $this->penempatanSiswaInterface->listPenempatanSiswa($param);
    }
}