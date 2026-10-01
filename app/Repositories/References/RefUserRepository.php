<?php

namespace App\Repositories\References;

use App\Models\References\RefUser;

class RefUserRepository extends RefUser
{
    /**
     * Digunakan untuk melakukan pencarian data berdasarkan username
     * @param string $username
     * @return mixed
     */
    public function findDataByUsername(string $username)
    {
        return self::where('username', $username)
            ->first();
    }
}
