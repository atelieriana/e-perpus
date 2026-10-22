<?php

namespace App\Services;

use App\Http\Controllers\Datatables\Siswa;

readonly class KelulusanService
{
    public function __construct(
        private PenempatanSiswaService $penempatanSiswaService,
    )
    {}

    public function getSiswaKelasXII(string $uuidTahunAjar = null)
    {
        if (is_null($uuidTahunAjar)) {
            return $this->penempatanSiswaService->getSiswaKelasXII();
        }
    }
}