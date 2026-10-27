<?php

namespace App\Models\Transactions;

use App\Traits\AuditTransaction;
use App\Traits\LogTransaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HibahBuku extends Model
{
    use SoftDeletes,
        AuditTransaction,
        LogTransaction;

    protected $table = 'trans_hibah_buku';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_ref_siswa',
        'id_ref_buku',
        'tanggal_sumbang'
    ];
}