<?php


namespace App\Services\Category\Handlers;


use App\Models\Category;
use App\Services\Base\Category\Repositories\BaseCategoryRepository;

class DestroyHandler
{
    /**
     * @param Category $category
     * @param BaseCategoryRepository $repository
     * @return int
     */
    public function handle(Category $category, BaseCategoryRepository $repository): int
    {
        uploader()->remove($category->image_path);

        return $repository->destroy($category);
    }
}
