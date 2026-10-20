<?php

namespace App\Models\References;

use App\Traits\AuditTransaction;
use App\Traits\LogTransaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class RefBukuPaket extends Model implements Auditable
{
    use SoftDeletes,
        AuditTransaction,
        LogTransaction;

    protected $table = 'ref_buku_paket';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid',
        'id_ref_kejuruan',
        'id_ref_buku',
        'id_ref_kelas',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];
}
