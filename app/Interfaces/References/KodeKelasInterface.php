<?php

namespace App\Interfaces\References;

use App\Repositories\References\RefKodeKelasInterfaceRepository;
use Illuminate\Container\Attributes\Bind;

#[Bind(RefKodeKelasInterfaceRepository::class)]
interface KodeKelasInterface
{
    /**
     * Digunakan untuk membentuk format datatatbles kode kelas
     * @param int $start
     * @param int $end
     * @param string $search
     * @return mixed
     */
    public function dtKodeKelas(int $start, int $end, string $search);
}
