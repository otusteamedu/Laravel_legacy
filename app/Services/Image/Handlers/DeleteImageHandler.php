<?php


namespace App\Services\Image\Handlers;


use App\Models\Image;
use App\Services\Image\Repositories\ImageRepository;

class DeleteImageHandler
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
     * @return int
     * @throws \Exception
     */
    public function handle(Image $image): int {
        uploader()->remove($image->path);

        return $this->repository->destroy($image);
    }
}
