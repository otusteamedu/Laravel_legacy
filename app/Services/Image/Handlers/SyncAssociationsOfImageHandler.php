<?php


namespace App\Services\Image\Handlers;


use App\Models\Image;
use App\Services\Image\Repositories\ImageRepository;

class SyncAssociationsOfImageHandler
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

    public function handle(string $relation, $data, Image $image) {
        $this->repository->syncAssociations($relation, $data, $image);
    }
}
