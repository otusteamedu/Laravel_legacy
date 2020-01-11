<?php


namespace App\Services\Category\Handlers;


use App\Models\Category;
use App\Services\Category\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;

class GetCategoryImageListHandler
{
    /**
     * @var CategoryRepository
     */
    private $repository;

    /**
     * GetCategoryImageListHandler constructor.
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Category $category
     * @return Collection
     */
    public function handle(Category $category): Collection {
        return $this->repository->getImageList($category);
    }
}
