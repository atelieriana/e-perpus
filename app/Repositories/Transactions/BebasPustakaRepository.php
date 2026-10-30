<?php

namespace App\Repositories\Transactions;

use App\Interfaces\Transactions\BebasPustakaInterface;
use App\Models\Transactions\BebasPustaka;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class BebasPustakaRepository extends BaseRepository implements BebasPustakaInterface
{
    public function __construct(BebasPustaka $bebasPustaka)
    {
        parent::__construct($bebasPustaka);
    }
}