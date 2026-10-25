<?php

namespace App\Repositories\References;

use App\Interfaces\References\RefStatusPeminjamanInterface;
use App\Models\References\RefStatusPeminjaman;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class RefStatusPeminjamanRepository extends BaseRepository implements RefStatusPeminjamanInterface
{
    public function __construct(
        private RefStatusPeminjaman $refStatusPeminjaman
    )
    {
        parent::__construct($this->refStatusPeminjaman);
    }
}