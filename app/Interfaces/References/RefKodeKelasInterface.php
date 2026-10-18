<?php

namespace App\Interfaces\References;

use App\Repositories\References\RefRefKodeKelasRepository;
use Illuminate\Container\Attributes\Bind;

#[Bind(RefRefKodeKelasRepository::class)]
interface RefKodeKelasInterface
{
    /**
     * Digunakan untuk membentuk format datatatbles kode kelas
     * @param int $start
     * @param int $end
     * @param string $search
     * @return mixed
     */
    public function dtKodeKelas(int $start = null, int $end = null, string $search = null);
}
