<?php


namespace App\Services\Category\Handlers;


use App\Models\Category;
use App\Services\Category\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;

class GetCategoryExcludedImageListHandler
{
    /**
     * @var CategoryRepository
     */
    private $repository;

    /**
     * GetCategoryExcludedImageListHandler constructor.
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
        return $this->repository->getExcludedImageList($category);
    }
}
