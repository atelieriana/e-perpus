<?php

namespace App\Interfaces\Transactions;

use App\Repositories\Transactions\PeminjamanBukuRepository;
use Illuminate\Container\Attributes\Bind;

#[Bind(PeminjamanBukuRepository::class)]
interface PeminjamanBukuInterface
{
    public function dtDataPeminjamanBukuUmum(int $start = null, int $end = null, string $search = null);

    public function dtHistoryPeminjamanSiswa(int $idRefSiswa, int $start = null, int $end = null, string $search = null);

    public function getPeminjamanBukuByKodeKelasDanTahun(int $idRefKodeKelas, int $idRefTahunAjar);

    public function massUpsert($arrayData);

    public function getPeminjamanBySiswaDanTanggalPinjam(int $idRefSiswa, string $tanggalPinjam);

    public function getPeminjamanBelumKembali(int $idRefSiswa);
}