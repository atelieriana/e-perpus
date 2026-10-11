<?php

namespace App\Services;

use App\Repositories\References\RefSiswaIRepository;
use Illuminate\Support\Collection;

readonly class SiswaService
{
    public function __construct(
        private RefSiswaIRepository $refSiswaIRepository,
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
        return $this->refSiswaIRepository->dtSiswa($start, $length, $search);
    }
}