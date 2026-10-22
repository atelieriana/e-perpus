<?php

namespace App\Interfaces\Transactions;

use App\Repositories\Transactions\PenempatanSiswaRepository;
use Illuminate\Container\Attributes\Bind;

#[Bind(PenempatanSiswaRepository::class)]
interface PenempatanSiswaInterface
{
    /**
     * Digunakan untuk membuat datatables penempatan siswa
     * @param int $start
     * @param int $end
     * @param string $seacrh
     * @return mixed
     */
    public function listPenempatanSiswa(array $params);

    public function getSiswaKelasXII(int $idRefTahunAjar = null);
}
