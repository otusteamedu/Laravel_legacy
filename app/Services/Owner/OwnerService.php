<?php


namespace App\Services\Owner;


use App\Http\Requests\FormRequest;
use App\Services\Base\Category\Handlers\ShowExcludedImagesHandler;
use App\Services\Base\Category\Handlers\ShowImagesHandler;
use App\Services\Base\Category\Handlers\UploadHandler;
use App\Services\Base\Resource\Handlers\ClearCacheByTagHandler;
use App\Services\Owner\Repositories\OwnerRepository;
use App\Services\SubCategory\SubCategoryService;

class OwnerService extends SubCategoryService
{
    /**
     * OwnerService constructor.
     * @param OwnerRepository $repository
     * @param ClearCacheByTagHandler $clearCacheByTagHandler
     * @param UploadHandler $uploadHandler
     * @param ShowImagesHandler $showImagesHandler
     * @param ShowExcludedImagesHandler $showExcludedImagesHandler
     */
    public function __construct(
        OwnerRepository $repository,
        ClearCacheByTagHandler $clearCacheByTagHandler,
        UploadHandler $uploadHandler,
        ShowImagesHandler $showImagesHandler,
        ShowExcludedImagesHandler $showExcludedImagesHandler
    )
    {
        parent::__construct(
            $repository,
            $clearCacheByTagHandler,
            $uploadHandler,
            $showImagesHandler,
            $showExcludedImagesHandler
        );
    }

    /**
     * @param array $images
     * @param int $id
     */
    public function associateWithImages(array $images, int $id)
    {
        array_map(function ($image) use ($images, $id) {
            $image->owner_id = $id;
            $image->save();
        }, $images);
    }

    /**
     * @param FormRequest $request
     * @param int $id
     */
    public function addImages(FormRequest $request, int $id)
    {
        $images = $request->toArray();
        $this->repository->addImages($id, $images);
    }
}
