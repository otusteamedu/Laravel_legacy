<?php


namespace App\Services\FilterTypes;


use App\Models\FilterType;
use App\Services\FilterTypes\Repositories\FilterTypeRepositoryInterface;

class FilterTypesService
{
    private FilterTypeRepositoryInterface $repository;


    public function __construct(
        FilterTypeRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function find(int $id)
    {
        return $this->repository->find($id);
    }

    public function getForCombobox()
    {
        return $this->repository->getForCombobox();
    }

    public function search(array $filters)
    {
        return $this->repository->search($filters);
    }

    public function create(array $data)
    {
        return $this->createPostHandler->handle($data);
    }

    public function update(FilterType $model, array $data)
    {
        return $this->updatePostHandler->handle($model, $data);
    }

    public function delete(FilterType $model)
    {
        return $this->repository->delete($model);
    }

}
