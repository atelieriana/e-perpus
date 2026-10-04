<?php

namespace App\Interfaces\References;

use App\Models\References\RefUser;
use App\Repositories\References\RefRoleRepository;
use Illuminate\Container\Attributes\Bind;

#[Bind(RefRoleRepository::class)]
interface RefRoleInterface
{
    public function findNameDefaultRole(RefUser $refUser, int $idRole);
}