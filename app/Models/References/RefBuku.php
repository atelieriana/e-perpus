<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;

class RefBuku extends Model
{
    protected $table = 'ref_buku';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid',
        'id_ref_jenis_buku',
        'judul',
        'kota_penerbit',
        'penerbit',
        'penulis',
        'tahun_terbit',
        'isbn',
        'halaman',
        'deskripsi_fisik',
        'jumlah_buku',
        'file_cover',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
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