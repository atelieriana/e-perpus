<?php

namespace App\Models\Transactions;

use App\Models\References\RefSiswa;
use App\Traits\AuditTransaction;
use App\Traits\LogTransaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class SuratBebasPinjam extends Model implements Auditable
{
    use SoftDeletes,
        AuditTransaction,
        LogTransaction;

    protected $table = 'trans_surat_bebas_pinjam';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid',
        'id_ref_siswa',
        'id_ref_jenis_bebas_pinjam',
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