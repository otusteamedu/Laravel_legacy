<?php


namespace App\Services\Image\Handlers;


use App\Models\Image;
use App\Services\Image\Repositories\CmsImageRepository;

class SyncAssociativeCategoryOfImageHandler
{
    private CmsImageRepository $repository;

    /**
     * UploadImageHandler constructor.
     * @param CmsImageRepository $repository
     */
    public function __construct(CmsImageRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Image $image
     * @param string $relation
     * @param $syncKeys
     */
    public function handle(Image $image, string $relation, $syncKeys)
    {
        $syncData = $syncKeys
            ? array_fill_keys($syncKeys, ['category_type' => $relation])
            : [];

        $this->repository->syncAssociations($image, $relation, $syncData);
    }
}
