<?php

namespace App\Services;

use App\Interfaces\References\RefBukuInterface;

readonly class BukuPaketService
{
    public function __construct(
        private RefBukuInterface $refBukuInterface,
    )
    {}
}