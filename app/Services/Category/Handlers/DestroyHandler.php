<?php


namespace App\Services\Category\Handlers;


use App\Models\Category;
use App\Services\Category\Repositories\CmsCategoryRepository;

class DestroyHandler
{
    private CmsCategoryRepository $repository;

    /**
     * DestroyHandler constructor.
     * @param CmsCategoryRepository $repository
     */
    public function __construct(CmsCategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Category $category
     * @return int
     */
    public function handle(Category $category): int
    {
        uploader()->remove($category->image_path);

        return $this->repository->destroy($category);
    }
}
