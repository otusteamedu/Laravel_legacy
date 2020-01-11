<?php


namespace App\Services\Image\Handlers;


use App\Models\Image;
use App\Services\Image\Repositories\ImageRepository;

class SyncAssociativeCategoryOfImageHandler
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
        $syncData = [];
        if ($data) {
            foreach ($data as $value) {
                $syncData[$value] = ['category_type' => $relation];
            }
        }

        $this->repository->syncAssociations($relation, $syncData, $image);
    }
}
