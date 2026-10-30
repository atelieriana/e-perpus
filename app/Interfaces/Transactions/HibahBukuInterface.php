<?php

namespace App\Interfaces\Transactions;

use App\Repositories\Transactions\HibahBukuRepository;
use Illuminate\Container\Attributes\Bind;

#[Bind(HibahBukuRepository::class)]
interface HibahBukuInterface
{
    public function dtHibahBuku(int $start = null, int $end = null, string $search = null);

    public function checkHibahByIdSiswa(int $idSiswa);
}