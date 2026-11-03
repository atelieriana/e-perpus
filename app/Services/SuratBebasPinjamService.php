<?php

namespace App\Services;

use App\Exceptions\BusinessException;
use App\Interfaces\References\RefSiswaInterface;
use App\Interfaces\Transactions\SuratBebasPinjamInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

readonly class SuratBebasPinjamService
{
    public function __construct(
        private SuratBebasPinjamInterface $bebasPustaka,
        private RefSiswaInterface $refSiswaInterface,
    )
    {}

    public function getDatatablesBebasPustaka(int $start = null, int $end = null, string $search = null)
    {
        return $this->bebasPustaka->dtBebasPustaka($start, $end, $search);
    }

    public function getByNomorInduk(string $nomorInduk): mixed
    {
        $dataSiswa = $this->refSiswaInterface->getByNomorInduk($nomorInduk);
        return $this->bebasPustaka->findByIdSiswa($dataSiswa->id);
    }

    public function findByUUID(string $uuid)
    {
        return $this->bebasPustaka->findByUuid($uuid);
    }

    public function updateRecord(array $requestData)
    {
        $dataSuratBebasPinjam = $this->bebasPustaka->findByUuid($requestData['uuid-trans-surat-bebas-pinjam']);
        try
        {
            $data = [
                'tanggal_surat' => $requestData['tanggal-surat-bebas-peminjaman'],
            ];
            $this->bebasPustaka->update($data, $dataSuratBebasPinjam->id);
        }
        catch (QueryException $exception)
        {
            Log::error($exception->getMessage());
            throw new BusinessException("Terjadi kesalahan saat melakukan update surat bebas pinjam");
        }
    }

    public function updateFileLocation(array $requestData)
    {
        $dataSuratBebasPinjam = $this->bebasPustaka->findByUuid($requestData['uuid-trans-surat-bebas-pinjam']);
        try
        {
            $data = [
                'path_to_file' => $requestData['path-to-file'],
            ];
            $this->bebasPustaka->update($data, $dataSuratBebasPinjam->id);
        }
        catch (QueryException $exception)
        {
            Log::error($exception->getMessage());
            throw new BusinessException("Terjadi kesalahan saat melakukan update surat bebas pinjam");
        }
    }

    public function deleteRecord(array $requestData)
    {
        $dataSuratBebasPinjam = $this->bebasPustaka->findByUuid($requestData['uuid-trans-surat-bebas-pinjam']);
        try
        {
            $this->bebasPustaka->delete($dataSuratBebasPinjam->id);
        }
        catch (QueryException $exception)
        {
            Log::error($exception->getMessage());
            throw new BusinessException("Terjadi kesalahan saat melakukan hapus surat bebas pinjam");
        }
    }
}