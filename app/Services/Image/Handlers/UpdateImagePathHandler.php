<?php


namespace App\Services\Image\Handlers;


use App\Models\Image;
use App\Services\Image\Repositories\ImageRepository;
use Illuminate\Http\UploadedFile;

class UpdateImagePathHandler
{
    /**
     * @var ImageRepository
     */
    private $repository;

    /**
     * @var Image
     */
    private $uploadModel;

    /**
     * UploadImageHandler constructor.
     * @param ImageRepository $repository
     * @param Image $uploadModel
     */
    public function __construct(
        ImageRepository $repository,
        Image $uploadModel
    )
    {
        $this->repository = $repository;
        $this->uploadModel = $uploadModel;
    }

    public function handle(UploadedFile $imageFile, Image $image) {
        $upload = uploader();
        $uploadAttributes = $upload->upload($imageFile);
        $upload->remove($image->path);
        $upload->update($image, $uploadAttributes);
    }
}
