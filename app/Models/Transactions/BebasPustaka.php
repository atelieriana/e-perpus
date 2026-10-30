<?php

namespace App\Models\Transactions;

use App\Models\References\RefSiswa;
use Illuminate\Database\Eloquent\Model;

class BebasPustaka extends Model
{
    protected $table = 'trans_bebas_pustaka';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tanggal_bebas_pustaka',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function ref_siswa()
    {
        return $this->belongsTo(RefSiswa::class, 'id_ref_siswa');
    }
}