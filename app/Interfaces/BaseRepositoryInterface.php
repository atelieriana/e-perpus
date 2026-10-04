<?php

namespace App\Interfaces;

use App\Repositories\BaseRepository;
use Illuminate\Container\Attributes\Bind;

#[Bind(BaseRepository::class)]
interface BaseRepositoryInterface
{
    public function find($id);
    public function findByUUID($uuid);

    public function create(array $data);

    public function update(array $data, int $id);

    public function delete(int $id);
}