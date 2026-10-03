<?php

namespace App\Repositories\References;

use App\Models\References\RefUser;
use Illuminate\Database\Eloquent\Builder;

readonly class RefUserRepository
{
    public function __construct(
        private RefUser $refUser
    )
    {}

    public function create(array $data)
    {
        return $this->refUser->newQuery()->create($data);
    }

    public function update(array $data, int $id)
    {
        return $this->refUser
            ->newQuery()
            ->findOrFail($id)
            ->update($data);
    }

    public function delete(int $id)
    {
        return $this->refUser
            ->newQuery()
            ->findOrFail($id)
            ->delete();
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
