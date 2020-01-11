<?php


namespace App\Services\Image\Handlers;


use App\Models\Image;
use App\Services\Image\Repositories\ImageRepository;
use Illuminate\Http\Request;

class UploadImageHandler
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

    /**
     * @param Request $request
     */
    public function handle(Request $request) {
        $images = $request->file('images');

        array_map(function ($image) {
            uploader()->store($image, $this->uploadModel);
        }, $images);
    }
}
