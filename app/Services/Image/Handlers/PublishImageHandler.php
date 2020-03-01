<?php


namespace App\Services\Image\Handlers;


use App\Models\Image;
use App\Services\Image\Repositories\ImageRepositoryCms;

class PublishImageHandler
{
    /**
     * @var ImageRepositoryCms
     */
    private $repository;

    /**
     * DeleteImageHandler constructor.
     * @param ImageRepositoryCms $repository
     */
    public function __construct(ImageRepositoryCms $repository)
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
