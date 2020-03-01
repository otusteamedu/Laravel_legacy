<?php


namespace App\Services\Category\Handlers;


use App\Models\Category;
use App\Services\Base\Resource\Repositories\CmsBaseResourceRepository;

class DestroyHandler
{
    /**
     * @param Category $category
     * @param CmsBaseResourceRepository $repository
     * @return int
     */
    public function handle(Category $category, CmsBaseResourceRepository $repository): int
    {
        uploader()->remove($category->image_path);

        return $repository->destroy($category);
    }
}
