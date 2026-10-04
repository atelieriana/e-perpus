<?php

namespace App\Services\Auth;

use App\Exceptions\BusinessException;
use App\Interfaces\References\RefUserInterface;
use App\Interfaces\Tokens\TokenForgetPasswordInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

readonly class TokenForgetPasswordService
{
    public function __construct(
        private RefUserInterface $refUserInterface,
        private TokenForgetPasswordInterface $tokenForgetPasswordInterface,
        private Session $session,
    )
    {}

    /**
     * @param array $dataUser
     * @return string
     */
    public function generateForgetToken(object $dataUser): string
    {
        $this->session::put('name', $dataUser['name']);

        try
        {
            $uuidTokenForgetPassword = Str::uuid()->toString();
            $token = base64_encode($uuidTokenForgetPassword.$dataUser['uuid']);
            $dataTokenForgetPassword = [
                'uuid' => $uuidTokenForgetPassword,
                'id_ref_user' => $dataUser['id'],
                'token' => $token,
                'expired_at' => Carbon::now('Asia/Jakarta')->addMinutes(30),
                'status' => 1,
                'created_by' => $this->session::get('name'),
                'updated_by' => $this->session::get('name'),
            ];
            $this->tokenForgetPasswordInterface->create($dataTokenForgetPassword);
        }
        catch (QueryException $e)
        {
            Log::error($e->getMessage());
            throw new BusinessException("Gagal melakukan generate token.");
        }

        $this->session::remove('name');

        return $token;
    }

    public function validateForgetToken(string $token)
    {
        return $this->tokenForgetPasswordInterface->findDataTokenByToken($token)
            ?? throw new BusinessException("Token sudah expired atau pernah digunakan. Silahkan kirim ulang link reset password.");
    }

    public function tokenOwner(string $token)
    {
        $dataToken = $this->tokenForgetPasswordInterface->findDataTokenByToken($token)->toArray()
            ?? throw new BusinessException("Token '{$token}' sudah expired atau sudah digunakan.");

        $this->refUserInterface->findDataActiveUserById($dataToken['id']);
    }

    public function invalidateForgetToken(array $requestData)
    {
        $dataToken = $this->tokenForgetPasswordInterface->findDataTokenByToken($requestData['token'])->toArray()
            ?? throw new BusinessException("Token sudah expired atau sudah digunakan.");

        $dataUpdateToken = [
            'status' => 0
        ];
        $this->tokenForgetPasswordInterface->update($dataUpdateToken, $dataToken['id']);
    }
}