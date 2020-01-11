<?php


namespace App\Services\Category\Handlers;

use App\Services\Category\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;

class GetCategoryListByTypeHandler
{
    /**
     * @var CategoryRepository
     */
    private $repository;

    /**
     * GetCategoryListByTypeHandler constructor.
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $type
     * @return Collection
     */
    public function handle(string $type): Collection {
        return $this->repository->indexByType($type);
    }
}
