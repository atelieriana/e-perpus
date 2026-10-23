<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;

class RefKelas extends Model
{
    const ID_KELAS_X = 1;
    const ID_KELAS_XI = 2;

    protected $table = 'ref_kelas';
    protected $primaryKey = 'id';

    #[Scope]
    public function get_kelas_x_dan_xi()
    {
        return $this->where('id', self::ID_KELAS_X)
            ->orWhere('id', self::ID_KELAS_XI);
    }
}