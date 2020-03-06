<?php


namespace App\Services\Base\Category;


use App\Services\Base\Category\Repositories\CmsBaseCategoryRepository;
use App\Services\Base\Resource\CmsBaseResourceService;
use App\Services\Base\Category\Handlers\UploadHandler;
use App\Services\Base\Category\Handlers\GetImagesHandler;
use App\Services\Base\Category\Handlers\GetExcludedImagesHandler;
use App\Services\Base\Resource\Handlers\ClearCacheByTagHandler;
use App\Services\Cache\Tag;
use Illuminate\Support\Arr;

class CmsBaseCategoryService extends CmsBaseResourceService
{
    protected UploadHandler $uploadHandler;

    protected GetImagesHandler $getImagesHandler;

    protected GetExcludedImagesHandler $getExcludedImagesHandler;

    /**
     * CmsBaseCategoryService constructor.
     * @param CmsBaseCategoryRepository $repository
     * @param ClearCacheByTagHandler $clearCacheByTagHandler
     * @param UploadHandler $uploadHandler
     * @param GetImagesHandler $getImagesHandler
     * @param GetExcludedImagesHandler $getExcludedImagesHandler
     */
    public function __construct(
        CmsBaseCategoryRepository $repository,
        ClearCacheByTagHandler $clearCacheByTagHandler,
        UploadHandler $uploadHandler,
        GetImagesHandler $getImagesHandler,
        GetExcludedImagesHandler $getExcludedImagesHandler
    )
    {
        parent::__construct($repository, $clearCacheByTagHandler);
        $this->uploadHandler = $uploadHandler;
        $this->getImagesHandler = $getImagesHandler;
        $this->getExcludedImagesHandler = $getExcludedImagesHandler;
        $this->cacheTag = Tag::CATEGORIES_TAG;
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

        $this->uploadHandler->handle($category, $uploadImages, $this->repository);

        return $this->repository->getImages($category, $pagination);
    }

    /**
     * @param int $categoryId
     * @param array $pagination
     * @return mixed
     */
    public function getImages(int $categoryId, array $pagination)
    {
        $category = $this->repository->getItem($categoryId);

        return $this->getImagesHandler->handle($category, $pagination);
    }

    /**
     * @param int $categoryId
     * @param array $pagination
     * @return array
     */
    public function getItemWithImages(int $categoryId, array $pagination): array
    {
        $category = $this->repository->getItem($categoryId);
        $paginateData = $this->repository->getImages($category, $pagination);

        return ['item' => $category, 'paginateData' => $paginateData];
    }

    /**
     * @param int $categoryId
     * @param array $pagination
     * @return mixed
     */
    public function getExcludedImages(int $categoryId, array $pagination)
    {
        $category = $this->repository->getItem($categoryId);

        return $this->getExcludedImagesHandler->handle($category, $pagination);
    }

    /**
     * @param int $categoryId
     * @param array $pagination
     * @return array
     */
    public function getItemWithExcludedImages(int $categoryId, array $pagination): array
    {
        $category = $this->repository->getItem($categoryId);
        $paginateData = $this->repository->getExcludedImages($category, $pagination);

        return ['item' => $category, 'paginateData' => $paginateData];
    }

    /**
     * @param array $images
     * @param int $id
     */
    public function addImages(int $id, array $images)
    {
        $category = $this->repository->getItem($id);

        $this->repository->addImages($category, $images);
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

        return !!$this->repository->removeImage($category, $imageId)
            ? $this->getImagesHandler->handle($category, $pagination)
            : abort(500);
    }
}
