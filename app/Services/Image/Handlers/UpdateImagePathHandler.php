<?php


namespace App\Services\Image\Handlers;


use App\Models\Image;
use Illuminate\Http\UploadedFile;

class UpdateImagePathHandler
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

    public function handle(UploadedFile $imageFile, Image $image) {
        $upload = uploader();
        $uploadAttributes = $upload->upload($imageFile);
        $upload->remove($image->path);

        $upload->update($image, $uploadAttributes);
    }
}
