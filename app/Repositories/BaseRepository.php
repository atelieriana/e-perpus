<?php

namespace App\Repositories;

use App\Exceptions\BusinessException;
use Closure;
use App\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class BaseRepository implements BaseRepositoryInterface
{
    public function __construct(
        protected Model $model
    )
    {}

    /**
     * Digunakan untuk melakukan eksekusi ke database
     * @param Closure $callback
     * @param string $action
     * @return mixed
     */
    protected function execute(Closure $callback, string $action = 'query'): mixed
    {
        try
        {
            return $callback();
        }
        catch (QueryException $e)
        {
            Log::error("Database error on {$action}", [
                'model'    => get_class($this->model),
                'message'  => $e->getMessage(),
                'sql'      => $e->getSql(),
                'bindings' => $e->getBindings(),
                'code'     => $e->getCode(),
            ]);

            $message = match ($e->errorInfo[1] ?? null) {
                1062        => 'Data sudah ada (duplikat).',
                1451, 1452  => 'Data terkait dengan data lain dan tidak dapat diproses.',
                default     => 'Terjadi kesalahan pada database.',
            };

            throw new BusinessException($message, 0, $e);
        }
    }
    /**
     * Digunakan  untuk mendapatkan seluruh data
     * @return Collection
     */
    public function all()
    {
        return $this->execute(fn() => $this->model->all(), 'all');
    }

    /**
     * Digunakan untuk melakukan pecarian berdasarkan id
     * @param $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->execute(fn() => $this->model->find($id), 'find');
    }

    /**
     * Digunakan untuk melakukan pencarian berdasarkan id
     * @param $uuid
     * @return mixed
     */
    public function findByUUID(string $uuid)
    {
        return $this->execute(fn() => $this->model->where('uuid', $uuid, '=')->first(), 'findByUUID');
    }

    public function create(array $data)
    {
        return $this->execute(fn() => $this->model->create($data), 'create');
    }

    public function update(array $data, int $id)
    {
        return $this->execute(fn() => $this->model->find($id)->update($data), 'update');
    }

    public function delete(int $id)
    {
        return $this->execute(fn() => $this->model->find($id)->delete(), 'delete');
    }

    public function checkChanges()
    {
        return Arr::except($this->model->getChanges(), ['updated_at']);
    }
}