<?php


namespace App\Services\Category\Handlers;


use App\Models\Category;
use App\Services\Category\Repositories\CategoryRepository;

class DeleteCategoryHandler
{
    /**
     * @var CategoryRepository
     */
    private $repository;

    /**
     * DeleteCategoryHandler constructor.
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Category $category
     * @return int
     * @throws \Exception
     */
    public function handle(Category $category): int {
        uploader()->remove($category->image_path);

        return $this->repository->destroy($category);
    }
}
