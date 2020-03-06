<?php


namespace App\Services\Image\Handlers;


use App\Models\Image;
use App\Services\Image\Repositories\CmsImageRepository;

class PublishImageHandler
{
    private CmsImageRepository $repository;

    /**
     * DeleteImageHandler constructor.
     * @param CmsImageRepository $repository
     */
    public function __construct(CmsImageRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Image $image
     * @return Image
     */
    public function handle(Image $image): Image
    {
        return $this->repository->publish($image);
    }
}
