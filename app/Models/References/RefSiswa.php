<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class RefSiswa extends Model
{
    const STATUS_SISWA_AKTIF = 1;
    const STATUS_SISWA_PINDAH = 2;
    const STATUS_SISWA_LULUS = 3;

    protected $table = 'ref_siswa';
    protected $primaryKey = 'id';

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
