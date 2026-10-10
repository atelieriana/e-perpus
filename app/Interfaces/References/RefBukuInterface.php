<?php

namespace App\Interfaces\References;

use App\Repositories\References\RefBukuRepository;
use Illuminate\Container\Attributes\Bind;

#[Bind(RefBukuRepository::class)]
interface RefBukuInterface
{
    /**
     * Digunakan untuk menyediakan format datatables
     * @param int $id
     * @param int|null $start
     * @param int|null $end
     * @param string|null $search
     * @return mixed
     */
    public function dtDataByIdJenisBuku(int $id, int $start = null, int $end = null, string $search = null);
}