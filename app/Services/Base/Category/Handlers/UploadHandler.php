<?php


namespace App\Services\Base\Category\Handlers;


use App\Models\Image;
use App\Services\Base\Category\Repositories\BaseCategoryRepository;

class UploadHandler
{
    /**
     * @var Image
     */
    private $uploadModel;

    /**
     * UploadImagesToCategoryHandler constructor.
     * @param Image $uploadModel
     */
    public function __construct(Image $uploadModel)
    {
        $this->uploadModel = $uploadModel;
    }

    /**
     * @param array $uploadImages
     * @param BaseCategoryRepository $repository
     * @param $category
     * @return mixed
     */
    public function handle(array $uploadImages, BaseCategoryRepository $repository, $category)
    {
        $images = array_map(function ($image) {
            $image = uploader()->store($image, $this->uploadModel);
            return $image->id;
        }, $uploadImages);

        $repository->addImages($category, $images);

        return $category;
    }
}
