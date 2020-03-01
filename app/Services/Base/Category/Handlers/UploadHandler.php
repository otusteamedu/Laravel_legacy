<?php


namespace App\Services\Base\Category\Handlers;


use App\Models\Image;
use App\Services\Base\Resource\Repositories\CmsBaseResourceRepository;

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
     * @param CmsBaseResourceRepository $repository
     * @param $category
     * @return mixed
     */
    public function handle(array $uploadImages, CmsBaseResourceRepository $repository, $category)
    {
        $images = array_map(function ($image) {
            $image = uploader()->store($image, $this->uploadModel);
            return $image->id;
        }, $uploadImages);

        $repository->addImages($category, $images);

        return $category;
    }
}
