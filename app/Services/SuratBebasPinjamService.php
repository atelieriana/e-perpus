<?php

namespace App\Services;

use App\Interfaces\Transactions\SuratBebasPinjamInterface;

readonly class SuratBebasPinjamService
{
    public function __construct(
        private SuratBebasPinjamInterface $bebasPustaka,
    )
    {}

    public function getDatatablesBebasPustaka(int $start = null, int $end = null, string $search = null)
    {
        return $this->bebasPustaka->dtBebasPustaka($start, $end, $search);
    }
}