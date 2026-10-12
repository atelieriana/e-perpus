<?php

namespace App\Services;

use App\Exceptions\BusinessException;
use App\Interfaces\References\RefSiswaInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;

readonly class SiswaService
{
    public function __construct(
        private RefSiswaInterface $refSiswaInterface,
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
     * Service yang digunakan untuk menciptakan record siswa pada database
     * @param array $araryRequest
     * @return RedirectResponse|void
     */
    public function createRecordSiswa(array $araryRequest)
    {
        try
        {
            $this->refSiswaInterface->create($araryRequest);
        }
        catch (BusinessException $exception)
        {
            return response()
                ->redirectToRoute('siswa.create')
                ->with('error', $exception->getMessage());
        }
    }
}