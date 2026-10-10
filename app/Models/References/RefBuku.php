<?php

namespace App\Models\References;

use App\Traits\AuditTransaction;
use App\Traits\LogTransaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class RefBuku extends Model implements Auditable
{
    use SoftDeletes,
        AuditTransaction,
        LogTransaction;

    protected $table = 'ref_buku';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid',
        'id_ref_jenis_buku',
        'judul',
        'kota_terbit',
        'penerbit',
        'penulis',
        'tahun_terbit',
        'isbn',
        'halaman',
        'deskripsi_fisik',
        'jumlah_buku',
        'file_cover'
    ];

    protected $hidden = [
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];
}