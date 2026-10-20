<?php

namespace App\Interfaces\References;

use App\Repositories\References\RefBukuPaketRepository;
use Illuminate\Container\Attributes\Bind;

#[Bind(RefBukuPaketRepository::class)]
interface RefBukuPaketInterface
{
    /**
     * Digunakan untuk menyediakan data buku paket
     * @param int|null $start
     * @param int|null $end
     * @param string|null $search
     * @return mixed
     */
    public function dtDataBukuPaket(int $start = null, int $end = null, string $search = null);
}