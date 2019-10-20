<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class EloquentBaseRepository implements RepositoryInterface
{
    /**
     * @param int  $id
     * @param bool $exception
     *
     * @return Model|null
     */
    public function find(int $id, $exception = false): ?Model
    {
        $method = $exception ? 'findOrFail' : 'find';

        return $this->newModel()->newQuery()->{$method}($id);
    }

    /**
     * @param array $filters
     *
     * @return Collection
     */
    public function search(array $filters = [])
    {
        return $this->newModel()->newQuery()->where(function (Builder $query) use ($filters) {
            foreach ($filters as $key => $value) {
                $query->where($key, $value);
            }
        })->get();
    }

    public function createFromArray(array $data): Model
    {
        return $this->newModel()->newQuery()->create($data);
    }

    public function updateFromArray(Model $model, array $data): Model
    {
        $model->update($data);

        return $model;
    }

    /**
     * @return Modelы
     */
    protected function newModel()
    {
        $classModel = $this->model();

        return new $classModel();
    }

    public function bind($value)
    {
        return $this->find($value) ?? abort(404);
    }

    /**
     * @return string
     */
    abstract protected function model();
}
