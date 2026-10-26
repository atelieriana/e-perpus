<?php

namespace App\Services;

use App\Interfaces\Transactions\PeminjamanBukuInterface;

class PeminjamanBukuUmumService
{
    public function __construct(
        private PeminjamanBukuInterface $peminjamanBuku,
    )
    {}

    /**
     * @param int|null $start
     * @param int|null $end
     * @param string|null $search
     * @return mixed
     */
    public function getDatatablesPemeinjamanUmum(int $start = null, int $end = null, string $search = null)
    {
        return $this->peminjamanBuku->dtDataPeminjamanBukuUmum($start, $end, $search);
    }
}