<?php

namespace App\Models\References;

use App\Traits\AuditTransaction;
use App\Traits\LogTransaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class RefKodeKelas extends Model implements Auditable
{
    use SoftDeletes,
        AuditTransaction,
        LogTransaction;

    protected $table = 'ref_kode_kelas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid',
        'id_ref_kelas',
        'id_ref_kejuruan',
        'kode_kelas',
        'deskripsi',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

    public function ref_kejuruan()
    {
        return $this->belongsTo(RefKejuruan::class, 'id_ref_kejuruan');
    }

    public function ref_kelas()
    {
        return $this->belongsTo(RefKelas::class, 'id_ref_kelas');
    }
}
