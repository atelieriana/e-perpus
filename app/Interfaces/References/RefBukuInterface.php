<?php

namespace App\Interfaces\References;

use App\Repositories\References\RefBukuRepository;
use Illuminate\Container\Attributes\Bind;

#[Bind(RefBukuRepository::class)]
interface RefBukuInterface
{
    /**
     * Digunakan untuk melakukan pencarian berdasarkan id_ref_jenis buku
     * @param int $id
     * @return mixed
     */
    public function findDataByIdJenisBuku(int $id, int $start = null, int $end = null);
}