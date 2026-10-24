<?php

namespace App\Repositories\Views;

use App\Interfaces\Views\MappingKelasSebelumDanSelanjutnyaInterface;
use App\Models\Views\MappingKelasSebelumDanSelanjutnya;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class MappingKelasSebelumDanSelanjutnyaRepository extends BaseRepository implements MappingKelasSebelumDanSelanjutnyaInterface
{
    public function __construct(MappingKelasSebelumDanSelanjutnya $mappingKelasSebelumDanSelanjutnya)
    {
        parent::__construct($mappingKelasSebelumDanSelanjutnya);
    }
}