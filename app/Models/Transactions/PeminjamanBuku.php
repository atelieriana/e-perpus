<?php

namespace App\Models\Transactions;

use App\Traits\AuditTransaction;
use App\Traits\LogTransaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class PeminjamanBuku extends Model implements Auditable
{
    use SoftDeletes,
        AuditTransaction,
        LogTransaction;

    protected $table = 'trans_peminjaman_buku';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid',
        'id_ref_jenis_peminjaman',
        'id_trans_penempatan_siswa',
        'id_ref_buku',
        'id_ref_status_peminjaman',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}