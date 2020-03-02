<?php


namespace App\Services\Image\Handlers;


use App\Models\Image;
use App\Services\Image\Repositories\CmsImageRepository;

class DeleteImageHandler
{
    /**
     * @var CmsImageRepository
     */
    private $repository;

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
     * @return int
     * @throws \Exception
     */
    public function handle(Image $image): int {
        uploader()->remove($image->path);

        return $this->repository->destroy($image);
    }
}
