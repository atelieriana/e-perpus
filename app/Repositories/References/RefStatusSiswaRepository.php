<?php

namespace App\Repositories\References;

use App\Interfaces\References\RefStatusSiswaInterface;
use App\Models\References\RefStatusSiswa;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class RefStatusSiswaRepository extends BaseRepository implements RefStatusSiswaInterface
{
    public function __construct(RefStatusSiswa $refStatusSiswa)
    {
        parent::__construct($refStatusSiswa);
    }
}