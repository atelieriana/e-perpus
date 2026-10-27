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

    public function getSiswaKelasXII(string $uuidRefTahunAjar, int $startData = null, int $endData = null, string $searchData = null);

    public function getSiswaKelasXOrXI(int $idTahunAjar, int $idKelas);

    public function getSiswaByKelasDanKejuruan(int $idTahunAjar, int $idKelas);

    public function getSiswaByKodeKelasDanTahunAjar(int $idKodeKelas, int $idTahunAjar);
}
