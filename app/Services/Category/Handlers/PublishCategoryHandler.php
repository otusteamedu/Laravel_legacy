<?php


namespace App\Services\Category\Handlers;

use App\Models\Category;
use App\Services\Category\Repositories\CategoryRepository;

class PublishCategoryHandler
{
    /**
     * @var CategoryRepository
     */
    private $repository;

    /**
     * PublishCategoryHandler constructor.
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Category $category
     * @return Category
     */
    public function handle(Category $category): Category {
        return $this->repository->publish($category);
    }
}
