<?php

namespace App\Models\Transactions;

use App\Models\References\RefSiswa;
use Illuminate\Database\Eloquent\Model;

class SuratBebasPinjam extends Model
{
    protected $table = 'trans_surat_bebas_pinjam';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tanggal_surat',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function ref_siswa()
    {
        return $this->belongsTo(RefSiswa::class, 'id_ref_siswa');
    }
}