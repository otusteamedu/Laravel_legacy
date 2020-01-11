<?php


namespace App\Services\Image\Handlers;


use App\Models\Image;
use App\Services\Image\Repositories\ImageRepository;

class FillAttributesOfImageHandler
{
    /**
     * @var ImageRepository
     */
    private $repository;

    /**
     * UploadImageHandler constructor.
     * @param ImageRepository $repository
     */
    public function __construct(ImageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(array $data, Image $image) {
        $this->repository->fillAttributesFromArray($data, $image);
    }
}
