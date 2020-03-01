<?php


namespace App\Services\Image\Handlers;


use App\Models\Image;
use App\Services\Image\Repositories\ImageRepositoryCms;

class DeleteImageHandler
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
     * @return int
     * @throws \Exception
     */
    public function handle(Image $image): int {
        uploader()->remove($image->path);

        return $this->repository->destroy($image);
    }
}
