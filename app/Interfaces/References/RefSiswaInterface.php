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
     * @param string $uuidTahunAjar
     * @param string $uuidKelas
     * @return mixed
     */
    public function getSiswaByKelasDanTahunAjar(int $idRefTahunAjar, int $idRefKelas, int $start = null, $end = null, $search = null);

    /**
     * Digunakan untuk melakukan mass update proses kelulusan
     * @param int $idTahunAjar
     * @return mixed
     */
    public function massUpdateSiswaLulusByTahunAjar(int $idTahunAjar);

    /**
     * Digunakan untuk melakukan mass rollback proses kelulusan
     * @param int $idTahunAjar
     * @return mixed
     */
    public function massRollbackSiswaLulusByTahunAjar(int $idTahunAjar);
}