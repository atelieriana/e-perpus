<?php

namespace App\Interfaces\References;

use App\Repositories\References\RefJenisBebasPinjamRepository;
use Illuminate\Container\Attributes\Bind;

#[Bind(RefJenisBebasPinjamRepository::class)]
interface RefJenisBebasPinjamInterface
{

}