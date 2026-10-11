<?php

namespace App\Interfaces\References;

use App\Repositories\References\RefStatusSiswaRepository;
use Illuminate\Container\Attributes\Bind;

#[Bind(RefStatusSiswaRepository::class)]
interface RefStatusSiswaInterface
{

}