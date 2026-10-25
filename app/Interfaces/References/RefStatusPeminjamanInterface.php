<?php

namespace App\Interfaces\References;

use App\Repositories\References\RefStatusPeminjamanRepository;
use Illuminate\Container\Attributes\Bind;

#[Bind(RefStatusPeminjamanRepository::class)]
interface RefStatusPeminjamanInterface
{

}