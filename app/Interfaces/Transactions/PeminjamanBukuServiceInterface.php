<?php

namespace App\Interfaces\Transactions;

use App\Repositories\Transactions\PeminjamanBukuRepository;
use Illuminate\Container\Attributes\Bind;

#[Bind(PeminjamanBukuRepository::class)]
interface PeminjamanBukuServiceInterface
{

}