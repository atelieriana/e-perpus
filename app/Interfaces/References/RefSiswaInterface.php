<?php

namespace App\Interfaces\References;

use App\Repositories\References\RefSiswaIRepository;
use Illuminate\Container\Attributes\Bind;

#[Bind(RefSiswaIRepository::class)]
interface RefSiswaInterface
{
    /**
     * Digunakan untuk menyediakan data siswa dalam format datatables
     * @param $start
     * @param int|null $end
     * @param string|null $search
     * @return mixed
     */
    public function dtSiswa(int $start = null, int $end = null, string $search = null): mixed;
}