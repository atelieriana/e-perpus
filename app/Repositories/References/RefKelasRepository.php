<?php

namespace App\Repositories\References;

use App\Interfaces\References\RefKelasInterface;
use App\Models\References\RefKelas;
use App\Repositories\BaseRepository;

class RefKelasRepository extends BaseRepository implements RefKelasInterface
{
    public function __construct(
        private RefKelas $refKelas
    )
    {
        parent::__construct($refKelas);
    }

    public function getKelasXdanXII()
    {
        return $this->refKelas->get_kelas_x_dan_xi()->get();
    }
}