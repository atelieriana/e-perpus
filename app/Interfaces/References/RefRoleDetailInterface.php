<?php

namespace App\Interfaces\References;

use App\Models\References\RefUser;
use App\Repositories\References\RefRoleDetailRepository;
use Illuminate\Container\Attributes\Bind;

#[Bind(RefRoleDetailRepository::class)]
interface RefRoleDetailInterface
{
    /**
     * Digunakan untuk mendapatkan id default role dari sebuah akun
     * @param RefUser $refUser
     * @return mixed
     */
    public function findIdDefaultRole(RefUser $refUser);
}