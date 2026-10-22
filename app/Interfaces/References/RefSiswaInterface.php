<?php

namespace App\Interfaces\References;

use App\Repositories\References\RefSiswaRepository;
use Illuminate\Container\Attributes\Bind;

#[Bind(RefSiswaRepository::class)]
interface RefSiswaInterface
{
    /**
     * Digunakan untuk menyediakan data siswa dalam format datatables
     * @param $start
     * @param int|null $end
     * @param string|null $search
     * @return mixed
     */
    public function dtSiswa(int $start = null, int $end = null, string $search = null): mixed;

    /**
     * Digunakan untuk menyediakan data siswa tanpa kelas berdasarkan tahun ajar
     * @param string $uuidTahunAjar
     * @return mixed
     */
    public function getSiswaTanpaKelas(string $uuidTahunAjar);

    /**
     * @param int $idTahunAjar
     * @return mixed
     */
    public function massUpdateSiswaLulusByTahunAjar(int $idTahunAjar);
}