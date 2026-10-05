<?php

namespace App\Repositories\References;

use App\Interfaces\References\RefUserInterface;
use App\Models\References\RefUser;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class RefUserRepository extends BaseRepository implements RefUserInterface
{
    public function __construct(protected RefUser $refUser)
    {
        parent::__construct($refUser);
    }

    /**
     * Digunakan untuk melakukan pencarian data berdasarkan username
     * @param string $username
     * @return RefUser|Builder|null
     */
    public function findDataByUsername(string $username)
    {
        return $this->refUser
            ->newQuery()
            ->with(['roles','roles_detail'])
            ->where('username', $username)
            ->where('deleted_at', null)
            ->first();
    }

    /**
     * Digunakan untuk melakukan pencarian data berdasarkan email
     * @param string $email
     * @return mixed
     */
    public function findDataByEmail(string $email)
    {
        return $this->refUser
            ->newQuery()
            ->where('email', $email)
            ->where('deleted_at', null)
            ->first();
    }

    /**
     * Digunakan untuk melakukan pencarian data user yang aktif
     * @param int $id
     * @return mixed
     */
    public function findDataActiveUserById(int $id)
    {
        return $this->refUser
            ->newQuery()
            ->activeUser()
            ->where('id', $id)
            ->first();
    }
}
