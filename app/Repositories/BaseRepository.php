<?php

namespace App\Repositories;

use App\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class BaseRepository implements BaseRepositoryInterface
{
    public function __construct(protected Model $model)
    {}

    /**
     * Digunakan  untuk mendapatkan seluruh data
     * @return Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Digunakan untuk melakukan pecarian berdasarkan id
     * @param $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * Digunakan untuk melakukan pencarian berdasarkan id
     * @param $uuid
     * @return mixed
     */
    public function findByUUID(string $uuid)
    {
        return $this->model->where('uuid', $uuid)->first();
    }

    public function create(array $data)
    {
        $this->model->create($data);
    }

    public function update(array $data, int $id)
    {
        $this->model->find($id)->update($data);
    }

    public function delete(int $id)
    {
        $this->model->find($id)->delete();
    }

    public function checkChanges()
    {
        return Arr::except($this->model->getChanges(), ['updated_at']);
    }
}