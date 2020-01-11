<?php


namespace App\Services\Category\Handlers;

use App\Services\Category\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;

class GetAllCategoryHandler
{
    /**
     * @var CategoryRepository
     */
    private $repository;

    /**
     * GetAllCategoryHandler constructor.
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return Collection
     */
    public function handle(): Collection {
        return $this->repository->index();
    }
}
