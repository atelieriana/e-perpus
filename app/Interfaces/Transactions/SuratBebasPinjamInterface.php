<?php

namespace App\Interfaces\Transactions;

use App\Repositories\Transactions\SuratBebasPinjamRepository;
use Illuminate\Container\Attributes\Bind;

#[Bind(SuratBebasPinjamRepository::class)]
interface SuratBebasPinjamInterface
{
    public function dtBebasPustaka(int $start = null, int $end = null, string $search = null);
}