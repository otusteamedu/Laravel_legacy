<?php


namespace App\Services\Owner;


use App\Services\Base\Category\Handlers\GetExcludedImagesHandler;
use App\Services\Base\Category\Handlers\GetImagesHandler;
use App\Services\Base\Category\Handlers\UploadHandler;
use App\Services\Base\Resource\Handlers\ClearCacheByTagHandler;
use App\Services\Owner\Repositories\OwnerRepository;
use App\Services\SubCategory\SubCategoryService;
use Illuminate\Support\Arr;

class OwnerService extends SubCategoryService
{
    /**
     * OwnerService constructor.
     * @param OwnerRepository $repository
     * @param ClearCacheByTagHandler $clearCacheByTagHandler
     * @param UploadHandler $uploadHandler
     * @param GetImagesHandler $showImagesHandler
     * @param GetExcludedImagesHandler $showExcludedImagesHandler
     */
    public function __construct(
        OwnerRepository $repository,
        ClearCacheByTagHandler $clearCacheByTagHandler,
        UploadHandler $uploadHandler,
        GetImagesHandler $showImagesHandler,
        GetExcludedImagesHandler $showExcludedImagesHandler
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
     * @param array $requestData
     * @param int $id
     * @return mixed
     */
    public function upload(array $requestData, int $id)
    {
        $category = $this->repository->getItem($id);

        $uploadImages = $requestData['images'];
        $pagination = Arr::except($requestData, ['images']);

        $this->uploadHandler->handle($id, $uploadImages, $this->repository);

        return $this->repository->getImages($category, $pagination);
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
     * @param int $id
     * @param array $images
     */
    public function addImages(int $id, array $images)
    {
        $this->repository->addImages($id, $images);
    }

    /**
     * @param int $categoryId
     * @param int $imageId
     * @param array $pagination
     * @return mixed|void
     */
    public function removeImage(int $categoryId, int $imageId, array $pagination)
    {
        $category = $this->repository->getItem($categoryId);

        return !!$this->repository->removeImage(null, $imageId)
            ? $this->getImagesHandler->handle($category, $pagination)
            : abort(500);
    }
}
