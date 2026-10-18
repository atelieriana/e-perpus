<?php

namespace App\Interfaces\References;

use App\Repositories\References\RefKelasRepository;
use Illuminate\Container\Attributes\Bind;

#[Bind(RefKelasRepository::class)]
interface RefKelasInterface
{

}