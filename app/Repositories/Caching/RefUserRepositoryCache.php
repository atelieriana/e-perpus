<?php

namespace App\Repositories\Caching;

use App\Interfaces\References\RefUserInterface;

class RefUserRepositoryCache implements RefUserInterface
{

    /**
     * @inheritDoc
     */
    public function findDataByUsername(string $username)
    {
        // TODO: Implement findDataByUsername() method.
    }

    /**
     * @inheritDoc
     */
    public function findDataByEmail(string $email)
    {
        // TODO: Implement findDataByEmail() method.
    }

    /**
     * @inheritDoc
     */
    public function findDataActiveUserById(int $id)
    {
        // TODO: Implement findDataActiveUserById() method.
    }
}