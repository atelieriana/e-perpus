<?php

namespace App\Interfaces\Views;

use App\Repositories\Views\MappingKelasSebelumDanSelanjutnyaRepository;
use Illuminate\Container\Attributes\Bind;

#[Bind(MappingKelasSebelumDanSelanjutnyaRepository::class)]
interface MappingKelasSebelumDanSelanjutnyaInterface
{

}