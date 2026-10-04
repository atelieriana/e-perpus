<?php

namespace App\Services;

use App\Exceptions\BusinessException;
use App\Interfaces\References\RefUserInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

readonly class RefUserServices
{
    public function __construct(
        private RefUserInterface $refUserInterface,
        private Session $session
    )
    {}

    public function updatePassword(array $requestData)
    {
        $dataUser = $this->refUserInterface->findByUUID($requestData['id-user'])->toArray();
        $this->session::put('name', $dataUser['nama']);
        $dataUpdateUser = [
            'password' => Hash::make($requestData['password'])
        ];

        try
        {
            $this->refUserInterface->update($dataUpdateUser, $dataUser['id']);
            $this->session::remove('name');
        }
        catch (QueryException $exception)
        {
            Log::error($exception->getMessage());
            throw new BusinessException("Terjadi kesalahan saat mengubah password.");
        }
    }
}