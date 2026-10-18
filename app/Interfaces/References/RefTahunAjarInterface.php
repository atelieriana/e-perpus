<?php

namespace App\Interfaces\References;

use App\Repositories\References\RefTahunAjarRepository;
use Illuminate\Container\Attributes\Bind;

#[Bind(RefTahunAjarRepository::class)]
interface RefTahunAjarInterface
{
    /**
     * Digunakan untuk menyediakan data tahun ajar dalam format datatables
     * @param int|null $start
     * @param int|null $end
     * @param string|null $search
     * @return mixed
     */
    public function dtDataKejuruan(int $start = null, int $end = null, string $search = null);
}