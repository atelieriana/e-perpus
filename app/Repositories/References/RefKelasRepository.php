<?php

namespace App\Repositories\References;

use App\Interfaces\References\RefKelasInterface;
use App\Models\References\RefKelas;
use App\Repositories\BaseRepository;

class RefKelasRepository extends BaseRepository implements RefKelasInterface
{
    public function __construct(RefKelas $refKelas)
    {
        parent::__construct($refKelas);
    }
}