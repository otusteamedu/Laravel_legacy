<?php


namespace App\Services\Category\Handlers;


use App\Models\Category;
use App\Services\Category\Repositories\CmsCategoryRepository;
use Illuminate\Support\Arr;

class UpdateHandler
{
    private CmsCategoryRepository $repository;

    /**
     * UpdateHandler constructor.
     * @param CmsCategoryRepository $repository
     */
    public function __construct(CmsCategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Category $category
     * @param array $updateData
     * @return mixed
     */
    public function handle(Category $category, array $updateData)
    {
        if($updateData['image']) {
            $uploadArray = uploader()->refresh($category->image_path, $updateData['image']);

            $updateData = Arr::add(Arr::except($updateData, ['image']), 'image_path', $uploadArray['path']);
        }

        return $this->repository->update($category, $updateData);
    }
}
