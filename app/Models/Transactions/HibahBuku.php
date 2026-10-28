<?php

namespace App\Models\Transactions;

use App\Traits\AuditTransaction;
use App\Traits\LogTransaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class HibahBuku extends Model implements Auditable
{
    use SoftDeletes,
        AuditTransaction,
        LogTransaction;

    protected $table = 'trans_hibah_buku';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid',
        'id_ref_siswa',
        'id_ref_buku',
        'tanggal_sumbang'
    ];
}