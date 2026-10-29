<?php

namespace App\Models\Transactions;

use App\Models\References\RefKejuruan;
use App\Models\References\RefKelas;
use App\Models\References\RefKodeKelas;
use App\Models\References\RefSiswa;
use App\Models\References\RefTahunAjar;
use App\Traits\AuditTransaction;
use App\Traits\LogTransaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class PenempatanSiswa extends Model implements Auditable
{
    use SoftDeletes,
        AuditTransaction,
        LogTransaction;

    protected $table = 'trans_penempatan_siswa';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid',
        'id_ref_siswa',
        'id_ref_kode_kelas',
        'id_ref_tahun_ajar',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

    public function ref_siswa()
    {
        return $this->belongsTo(RefSiswa::class, 'id_ref_siswa');
    }

    public function ref_kelas()
    {
        return $this->hasOneThrough(RefKelas::class, RefSiswa::class, 'id', 'id', 'id_ref_kelas');
    }

    public function ref_kode_kelas()
    {
        return $this->hasOne(RefKodeKelas::class, 'id', 'id_ref_kode_kelas');
    }

    public function ref_tahun_ajar()
    {
        return $this->belongsTo(RefTahunAjar::class, 'id_ref_tahun_ajar');
    }
}
