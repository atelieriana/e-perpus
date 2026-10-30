<?php

namespace App\Services;

use App\Exceptions\BusinessException;
use App\Interfaces\References\RefJenisBebasPinjamInterface;
use App\Interfaces\References\RefSiswaInterface;
use App\Interfaces\Transactions\HibahBukuInterface;
use App\Interfaces\Transactions\PeminjamanBukuInterface;
use App\Interfaces\Transactions\SuratBebasPinjamInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

readonly class HistoryPeminjamanService
{
    public function __construct(
        private PeminjamanBukuInterface $peminjamanBukuInterface,
        private RefSiswaInterface $refSiswaInterface,
        private SuratBebasPinjamInterface $suratBebasPinjamInterface,
        private RefJenisBebasPinjamInterface $jenisBebasPinjamInterface,
        private HibahBukuInterface $hibahBukuInterface,
    )
    {}

    public function dtPeminjamanBukuByIdSiswa(string $uuidRefSiswa, int $start = null, int $end = null, string $search = null)
    {
        $dataSiswa = $this->refSiswaInterface->findByUuid($uuidRefSiswa);
        return $this->peminjamanBukuInterface->dtHistoryPeminjamanSiswa($dataSiswa->id, $start, $end, $search);
    }

    public function createRecord(array $requestData)
    {
        $dataSiswa = $this->refSiswaInterface->findByUuid($requestData['uuid-ref-siswa']);
        $dataJenisBebasPinjam = $this->jenisBebasPinjamInterface->findByUuid($requestData['uuid-ref-jenis-bebas-pinjam']);
        $listPeminjaman = $this->peminjamanBukuInterface->getPeminjamanBelumKembali($dataSiswa->id);
        $hibahBuku = $this->hibahBukuInterface->checkHibahByIdSiswa($dataSiswa->id);
        if ($hibahBuku == 0)
        {
            throw new BusinessException('Siswa belum melakukan hibah buku');
        }
        if ($listPeminjaman->count() != 0)
        {
            throw new BusinessException("Terdapat peminjaman yang belum dikembalikan");
        }
        else
        {
            try
            {
                $data = [
                    'uuid' => Str::uuid()->toString(),
                    'id_ref_siswa' => $dataSiswa->id,
                    'id_ref_jenis_bebas_pinjam' => $dataJenisBebasPinjam->id,
                    'tanggal_surat' => $requestData['tanggal-surat-bebas-peminjaman'],
                ];
                $this->suratBebasPinjamInterface->create($data);
            }
            catch (QueryException $exception)
            {
                Log::error($exception->getMessage());
                throw new BusinessException("Terjadi kesalahan saat menyimpan data");
            }
        }
    }
}