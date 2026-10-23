<?php

namespace App\Services;

use App\Interfaces\References\RefSiswaInterface;

readonly class KenaikanKelasService
{
    public function __construct(
        private RefSiswaInterface $refSiswaInterface,
    )
    {}

    public function getSiswaByKelasDanTahunAjar()
    {

    }
}