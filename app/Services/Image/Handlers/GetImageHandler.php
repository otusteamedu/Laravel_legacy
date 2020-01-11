<?php


namespace App\Services\Image\Handlers;


use App\Models\Image;
use App\Services\Image\Repositories\ImageRepository;

class GetImageHandler
{
    /**
     * @var ImageRepository
     */
    private $repository;

    /**
     * GetAllImagesHandler constructor.
     * @param ImageRepository $repository
     */
    public function __construct(ImageRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id
     * @return Image
     */
    public function handle(int $id): Image {
        return $this->repository->show($id);
    }
}
