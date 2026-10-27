<?php

namespace App\Models\Transactions;

use App\Models\References\RefBuku;
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
        'id_ref_siswa',
        'id_ref_buku',
        'id_ref_status_peminjaman',
        'tanggal_mulai_pinjam',
        'tanggal_akhir_pinjam',
        'tanggal_pengembalian',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function ref_buku()
    {
        return $this->belongsTo(RefBuku::class, 'id_ref_buku');
    }
}