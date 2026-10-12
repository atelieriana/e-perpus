<?php

namespace App\Services;

use App\Interfaces\References\RefKejuruanInterface;

class KejuruanService
{
    public function __construct(
        private RefKejuruanInterface $refKejuruan,
    )
    {}

    /**
     * Digunakan untuk menyediakan service datatables data kejuruan
     * @param int|null $start
     * @param $length
     * @param $search
     * @return mixed
     */
    public function getDatatablesKejuruan(int $start = null, $length = null, $search = null)
    {
        return $this->refKejuruan->dtDataKejuruan($start, $length, $search);
    }
}