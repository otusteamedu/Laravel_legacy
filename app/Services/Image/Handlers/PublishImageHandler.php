<?php


namespace App\Services\Image\Handlers;


use App\Models\Image;
use App\Services\Image\Repositories\ImageRepository;

class PublishImageHandler
{
    /**
     * @var ImageRepository
     */
    private $repository;

    /**
     * DeleteImageHandler constructor.
     * @param ImageRepository $repository
     */
    public function __construct(ImageRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Image $image
     * @return Image
     */
    public function handle(Image $image): Image {
        return $this->repository->publish($image);
    }
}
