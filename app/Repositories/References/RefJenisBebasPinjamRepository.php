<?php

namespace App\Repositories\References;

use App\Interfaces\References\RefJenisBebasPinjamInterface;
use App\Models\References\RefJenisBebasPinjam;
use App\Repositories\BaseRepository;

class RefJenisBebasPinjamRepository extends BaseRepository Implements RefJenisBebasPinjamInterface
{
    public function __construct(RefJenisBebasPinjam $refJenisBebasPinjam)
    {
        parent::__construct($refJenisBebasPinjam);
    }
}