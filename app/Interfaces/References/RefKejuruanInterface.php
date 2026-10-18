<?php

namespace App\Interfaces\References;

use App\Repositories\References\RefKejuruanRepository;
use Illuminate\Container\Attributes\Bind;

#[Bind(RefKejuruanRepository::class)]
interface RefKejuruanInterface
{
    /**
     * Digunakan untuk membuat format data datatables
     * @param int|null $start
     * @param int|null $end
     * @param string|null $search
     * @return mixed
     */
    public function dtDataKejuruan(int $start = null, int $end = null, string $search = null);
}