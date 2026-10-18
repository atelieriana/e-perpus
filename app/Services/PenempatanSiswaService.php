<?php

namespace App\Services;

use App\Interfaces\Transactions\PenempatanSiswaInterface;

class PenempatanSiswaService
{
    public function __construct(
        private PenempatanSiswaInterface $penempatanSiswaInterface
    )
    {}
}