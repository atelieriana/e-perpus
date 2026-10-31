<?php

namespace App\Services;

use App\Exceptions\BusinessException;
use App\Interfaces\References\RefKejuruanInterface;
use App\Interfaces\References\RefKelasInterface;
use App\Interfaces\References\RefSiswaInterface;
use App\Interfaces\References\RefTahunAjarInterface;
use App\Interfaces\Transactions\PenempatanSiswaInterface;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

readonly class SiswaService
{
    public function __construct(
        private RefSiswaInterface $refSiswaInterface,
        private RefTahunAjarInterface $refTahunAjarInterface,
        private RefKelasInterface $refKelasInterface,
        private RefKejuruanInterface $refKejuruanInterface,
        private PenempatanSiswaInterface $penempatanSiswaInterface,
    )
    {}

    /**
     * Service yang digunakan untuk mendapatkan data siswa untuk datatables
     * @param int|null $start
     * @param $length
     * @param $search
     * @return Collection|mixed
     */
    public function getDatatablesSiswa(int $start = null, $length = null, $search = null)
    {
        return $this->refSiswaInterface->dtSiswa($start, $length, $search);
    }

    /**
     * Digunakan untuk menyediakan datatables berdasarkan kelas dan tahun ajar
     * @param string $uuidRefTahunAjar
     * @param string $uuidRefKelas
     * @param int|null $start
     * @param $length
     * @param $search
     * @return mixed
     */
    public function getDatatablesSiswaByKelasDanTahunBerjalan(string $uuidRefTahunAjar, string $uuidRefKelas, int $start = null, $end = null, $search = null)
    {

        $dataKelas = $this->refKelasInterface->findByUUID($uuidRefKelas);
        $dataTahunAjar = $this->refTahunAjarInterface->findByUUID($uuidRefTahunAjar);
        $dataCurrenTahunAjar = $this->refTahunAjarInterface->getCurrentTahunAjar();
        return $this->refSiswaInterface->getSiswaByKelasDanTahunAjar($dataCurrenTahunAjar->id, $dataTahunAjar->id, $dataKelas->id, $start, $end, $search);
    }

    /**
     * Service yang digunakan untuk mendapatkan data siswa berdasarkan UUID
     * @param string $uuid
     * @return mixed
     */
    public function findDataSiswaByUUID(string $uuid)
    {
        return $this->refSiswaInterface->findByUUID($uuid);
    }

    public function findById(int $idSiswa)
    {
        return $this->refSiswaInterface->find($idSiswa);
    }

    /**
     * @param string $uuidTahunAjar
     * @return mixed
     */
    public function getSiswaTanpaKelas(string $uuidTahunAjar)
    {
        return $this->refSiswaInterface->getSiswaTanpaKelas($uuidTahunAjar);
    }

    /**
     * @param string $uuidRefKelas
     * @param string $uuidRefKejuruan
     * @return mixed
     */
    public function getSiswaByKelasDanKodeKejuruan(string $uuidRefKelas, string $uuidRefKejuruan)
    {
        $dataKelas = $this->refKelasInterface->findByUUID($uuidRefKelas);
        $dataKejuruan = $this->refKejuruanInterface->findByUUID($uuidRefKejuruan);
        return $this->penempatanSiswaInterface->getSiswaByKelasDanKejuruan($dataKelas->id, $dataKejuruan->id);
    }

    public function getSiswaByKelasKejuruanDanTahunAjar(string $uuidRefKelas, string $uuidRefKejuruan, string $uuidRefTahunAjar)
    {
        $dataKelas = $this->refKelasInterface->findByUUID($uuidRefKelas);
        $dataKejuruan = $this->refKejuruanInterface->findByUUID($uuidRefKejuruan);
        $dataTahunAjar = $this->refTahunAjarInterface->findByUUID($uuidRefTahunAjar);
        return $this->penempatanSiswaInterface->getSiswaByKelasKejuruanDanTahunAjar($dataKelas->id, $dataKejuruan->id, $dataTahunAjar->id);
    }

    /**
     * Service yang digunakan untuk melakukan create data siswa pada database
     * @param array $araryRequest
     * @return RedirectResponse|mixed|null
     * @throws \Throwable
     */
    public function createRecordSiswa(array $araryRequest)
    {
        try
        {
            return DB::transaction(function () use ($araryRequest) {
                return $this->refSiswaInterface->create($araryRequest);
            });
        }
        catch (QueryException $exception)
        {
            Log::error($exception->getMessage());
            throw new BusinessException("Terjadi kesalahan saat menyimpan data siswa");
        }
    }

    /**
     * Service yang digunakan untuk melakukan update data siswa pada database
     * @param array $araryRequest
     * @param int $id
     * @return mixed
     * @throws \Throwable
     */
    public function updateRecordSiswa(array $araryRequest, int $id)
    {
        try
        {
            return DB::transaction(function () use ($araryRequest, $id) {
                return $this->refSiswaInterface->update($araryRequest, $id);
            });
        }
        catch (QueryException $exception)
        {
            Log::error($exception->getMessage());
            throw new BusinessException("Terjadi kesalahan saat mengubah data siswa");
        }
    }

    /**
     * Service yang digunakan untuk melakukan soft delete pada data siswa
     * @param int $id
     * @return mixed
     * @throws \Throwable
     */
    public function deleteRecordSiswa(int $id)
    {
        try
        {
            return DB::transaction(function () use ($id) {
                return $this->refSiswaInterface->delete($id);
            });
        }
        catch (QueryException $exception)
        {
            Log::error($exception->getMessage());
            throw new BusinessException("Terjadi kesalahan saat menghapus data siswa, data masih digunakan pada table lain");
        }
    }
}