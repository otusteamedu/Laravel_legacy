<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class EloquentBaseRepository implements RepositoryInterface
{
    protected $perPage = 15;
    protected $pageName = 'page';
    protected $columns = ['*'];

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
     * @param array $columns
     * @return Collection
     */
    public function search(array $filters = [], $columns = ['*'])
    {
        return $this->_search($filters)->get($columns);
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
     * @return Model
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

    public function paginate(array $filters = [], array $options = [])
    {
        $parameters = collect($options)->only(['perPage', 'columns', 'pageName', 'page']);

        return $this->_search($filters)->paginate(
            $parameters->get('perPage', $this->perPage),
            $parameters->get('columns', $this->columns),
            $parameters->get('pageName', $this->pageName),
            $parameters->get('page', 1)
        );
    }


    /**
     * @return string
     */
    abstract protected function model();

    protected function _search(array $filters = [])
    {
        return $this->newModel()->newQuery()->where(function (Builder $query) use ($filters) {
            foreach ($filters as $key => $value) {
                $query->where($key, $value);
            }
        });
    }
}
