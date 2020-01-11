<?php


namespace App\Services\Category\Handlers;


use App\Models\Category;
use App\Services\Category\Repositories\CategoryRepository;

class RemoveImageFromCategoryHandler
{
    /**
     * @var CategoryRepository
     */
    private $repository;

    /**
     * RemoveImageFromCategoryHandler constructor.
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Category $category
     * @param int $imageId
     * @return int
     */
    public function handle(Category $category, int $imageId): int {
        return $this->repository->removeImage($category, $imageId);
    }
}
