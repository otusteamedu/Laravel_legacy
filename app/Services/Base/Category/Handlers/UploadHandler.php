<?php


namespace App\Services\Base\Category\Handlers;


use App\Models\Image;
use App\Services\Base\Resource\Repositories\CmsBaseResourceRepository;

class UploadHandler
{
    private Image $uploadModel;

    /**
     * UploadHandler constructor.
     * @param Image $uploadModel
     */
    public function __construct(Image $uploadModel)
    {
        $this->uploadModel = $uploadModel;
    }

    /**
     * @param $category
     * @param array $uploadImages
     * @param CmsBaseResourceRepository $repository
     * @return mixed
     */
    public function handle($category, array $uploadImages, CmsBaseResourceRepository $repository)
    {
        $images = array_map(function ($image) {
            $image = uploader()->store($image, $this->uploadModel);

            return $image->id;
        }, $uploadImages);

        $repository->addImages($category, $images);

        return $category;
    }
}
