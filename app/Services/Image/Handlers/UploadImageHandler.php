<?php


namespace App\Services\Image\Handlers;


use App\Http\Requests\FormRequest;
use App\Models\Image;

class UploadImageHandler
{
    /**
     * @var Image
     */
    private $uploadModel;

    /**
     * UploadImageHandler constructor.
     * @param Image $uploadModel
     */
    public function __construct(Image $uploadModel)
    {
        $this->uploadModel = $uploadModel;
    }

    /**
     * @param FormRequest $request
     * @return array
     */
    public function handle(FormRequest $request): array
    {
        $images = $request->file('images');

        return array_map(function ($image) {
            return uploader()->store($image, $this->uploadModel);
        }, $images);
    }
}