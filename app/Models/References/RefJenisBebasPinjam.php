<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;

class RefJenisBebasPinjam extends Model
{
    protected $table = 'ref_jenis_bebas_pinjam';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid',
        'id_ref_jenis_bebas_pinjam',
        'id_ref_siswa',
        'tanggal_surat'
    ];
}