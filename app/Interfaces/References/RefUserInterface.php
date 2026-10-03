<?php

namespace App\Interfaces\References;

use App\Repositories\References\RefUserRepository;
use Illuminate\Container\Attributes\Bind;

#[Bind(RefUserRepository::class)]
interface RefUserInterface
{
    /**
     * Digunakan untuk mencari data berdasarkan username
     * @param string $username
     * @return mixed
     */
    public function findDataByUsername(string $username);

    /**
     * Digunakan untuk mencari data berdasarkan email
     * @param string $email
     * @return mixed
     */
    public function findDataByEmail(string $email);


    /**
     * Digunakan untuk mencari data user aktif berdasarkan id
     * @param int $id
     * @return mixed
     */
    public function findDataActiveUserById(int $id);
}