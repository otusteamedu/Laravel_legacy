<?php


namespace App\Services\Image\Handlers;


use App\Models\Image;

class UploadImageHandler
{
    private Image $uploadModel;

    /**
     * UploadImageHandler constructor.
     * @param Image $uploadModel
     */
    public function __construct(Image $uploadModel)
    {
        $this->uploadModel = $uploadModel;
    }

    /**
     * @param array $images
     * @return array
     */
    public function handle(array $images): array
    {
        return array_map(function ($image) {
            return uploader()->store($image, $this->uploadModel);
        }, $images);
    }
}
