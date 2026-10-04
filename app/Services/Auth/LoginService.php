<?php

namespace App\Services\Auth;

use App\Exceptions\LoginServiceException;
use App\Interfaces\References\RefRoleDetailInterface;
use App\Interfaces\References\RefRoleInterface;
use App\Interfaces\References\RefUserInterface;
use Illuminate\Support\Facades\Hash;

readonly class LoginService
{
    public function __construct(
        private RefUserInterface       $refUserRepository,
        private RefRoleDetailInterface $refRoleDetailRepository,
        private RefRoleInterface       $refRoleRepository
    )
    {}

    /**
     * @throws LoginServiceException
     * @param array $credentials
     * @return void
     */
    public function authenticate(array $credentials): void
    {
        $dataUser = $this->refUserRepository->findDataByUsername($credentials['username']);
        if (is_null($dataUser) || !Hash::check($credentials['password'], $dataUser->password)) {
            throw new LoginServiceException('Username atau password salah');
        }

        $idDefaultRole = $this->refRoleDetailRepository->findIdDefaultRole($dataUser);
        $dataDefaultRole = $this->refRoleRepository->findNameDefaultRole($dataUser, $idDefaultRole);
        if (is_null($dataDefaultRole)) {
            throw new LoginServiceException('Role default belum diset oleh adminsitrator, silahkan hubungi administrator.');
        }
        session()->put('access-role', $idDefaultRole);
        session()->put('access-data', $dataUser);
        session()->put('access-allowed-role',  $dataUser->roles->pluck('role')->toArray());
    }
}