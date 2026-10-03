<?php

namespace App\Repositories;

use App\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    public function __construct(protected Model $model)
    {}

    public function find($id)
    {
        return $this->model->find($id);
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
}