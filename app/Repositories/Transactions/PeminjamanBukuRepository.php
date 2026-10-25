<?php

namespace App\Repositories\Transactions;

use App\Interfaces\Transactions\PeminjamanBukuServiceInterface;
use App\Models\Transactions\PeminjamanBuku;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class PeminjamanBukuRepository extends BaseRepository implements PeminjamanBukuServiceInterface
{
    public function __construct(PeminjamanBuku $peminjamanBuku)
    {
        parent::__construct($peminjamanBuku);
    }
}