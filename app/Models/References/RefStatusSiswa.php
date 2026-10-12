<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;

class RefStatusSiswa extends Model
{
    protected $table = 'ref_status_siswa';
    protected $primaryKey = 'id';
    protected $hidden = [
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by',
    ];
}