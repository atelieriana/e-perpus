<?php

namespace App\Services;

use App\Exceptions\BusinessException;
use App\Interfaces\Transactions\SuratBebasPinjamInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

readonly class SuratBebasPinjamService
{
    public function __construct(
        private SuratBebasPinjamInterface $bebasPustaka,
    )
    {}

    public function getDatatablesBebasPustaka(int $start = null, int $end = null, string $search = null)
    {
        return $this->bebasPustaka->dtBebasPustaka($start, $end, $search);
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
}