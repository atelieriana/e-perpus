<?php

namespace App\Models\References;

use App\Traits\AuditTransaction;
use App\Traits\LogTransaction;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class RefSiswa extends Model implements Auditable
{
    use SoftDeletes,
        AuditTransaction,
        LogTransaction;

    const STATUS_SISWA_AKTIF = 1;
    const STATUS_SISWA_PINDAH = 2;
    const STATUS_SISWA_LULUS = 3;

    protected $table = 'ref_siswa';
    protected $primaryKey = 'id';

    protected $fillable = [
        'uuid',
        'id_ref_status_siswa',
        'nisn',
        'nomor_induk',
        'nama_lengkap',
        'gender'
    ];

    /**
     * Digunakan untuk melakukan join elloquent
     * @return HasOne
     */
    public function status_siswa()
    {
        return $this->hasOne(RefStatusSiswa::class, 'id', 'id_ref_status_siswa');
    }

    /**
     * Digunakan untuk mengambil scope siswa yang aktif saja
     * @param Builder $query
     * @return Builder
     */
    #[Scope]
    public function aktif(Builder $query): Builder
    {
        return $query->where('id_ref_status_siswa', self::STATUS_SISWA_AKTIF);
    }

    /**
     * Digunakan untuk mengambil scope siswa yang pindah saja
     * @param Builder $query
     * @return Builder
     */
    #[Scope]
    public function pindah(Builder $query): Builder
    {
        return $query->where('id_ref_status_siswa', self::STATUS_SISWA_PINDAH);
    }

    /**
     * Digunakan untuk mengambil siswa yang lulus saja
     * @param Builder $query
     * @return Builder
     */
    #[Scope]
    public function lulus(Builder $query): Builder
    {
        return $query->where('id_ref_status_siswa', self::STATUS_SISWA_LULUS);
    }
}
