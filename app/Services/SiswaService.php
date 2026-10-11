<?php

namespace App\Services;

use App\Interfaces\References\RefSiswaInterface;
use Illuminate\Support\Collection;

readonly class SiswaService
{
    public function __construct(
        private RefSiswaInterface $refSiswaInterface,
    )
    {}

    /**
     * Service yang digunakan untuk mendapatkan data siswa untuk datatables
     * @param int|null $start
     * @param $length
     * @param $search
     * @return Collection|mixed
     */
    public function getDatatablesSiswa(int $start = null, $length = null, $search = null)
    {
        return $this->refSiswaInterface->dtSiswa($start, $length, $search);
    }
}