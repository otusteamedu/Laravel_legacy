<?php


namespace App\Services\Filters;


use App\Services\Filters\Repositories\FilterRepositoryInterface;

class FiltersService
{

    /**
     * @var FilterRepositoryInterface
     */
    private FilterRepositoryInterface $repository;
    /**
     * @var CreateFilterHandler
     */
    private $createFilterHandler;

    public function __construct(
        FilterRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function search(array $filters)
    {
        return $this->repository->search($filters);
    }


}
