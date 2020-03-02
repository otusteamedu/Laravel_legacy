<?php


namespace App\Services\Base\Category;


use App\Http\Requests\FormRequest;
use App\Services\Base\Category\Handlers\ShowExcludedImagesHandler;
use App\Services\Base\Category\Repositories\CmsBaseCategoryRepository;
use App\Services\Base\Resource\CmsBaseResourceService;
use App\Services\Base\Category\Handlers\UploadHandler;
use App\Services\Base\Category\Handlers\ShowImagesHandler;
use App\Services\Base\Resource\Handlers\ClearCacheByTagHandler;

abstract class CmsBaseCategoryService extends CmsBaseResourceService
{
    protected UploadHandler $uploadHandler;

    protected ShowImagesHandler $showImagesHandler;

    protected ShowExcludedImagesHandler $showExcludedImagesHandler;

    /**
     * CmsBaseCategoryService constructor.
     * @param CmsBaseCategoryRepository $repository
     * @param ClearCacheByTagHandler $clearCacheByTagHandler
     * @param UploadHandler $uploadHandler
     * @param ShowImagesHandler $showImagesHandler
     * @param ShowExcludedImagesHandler $showExcludedImagesHandler
     */
    public function __construct(
        CmsBaseCategoryRepository $repository,
        ClearCacheByTagHandler $clearCacheByTagHandler,
        UploadHandler $uploadHandler,
        ShowImagesHandler $showImagesHandler,
        ShowExcludedImagesHandler $showExcludedImagesHandler
    )
    {
        parent::__construct($repository, $clearCacheByTagHandler);
        $this->uploadHandler = $uploadHandler;
        $this->showImagesHandler = $showImagesHandler;
        $this->showExcludedImagesHandler = $showExcludedImagesHandler;
        $this->cacheTag = 'categories';
    }

    /**
     * @param FormRequest $request
     * @param int $id
     * @return mixed
     */
    public function upload(FormRequest $request, int $id)
    {
        $category = $this->repository->show($id);
        $uploadImages = $request->file('images');
        $this->uploadHandler->handle($uploadImages, $this->repository, $category);

        return $this->repository->showImages($category, $request->except('images'));
    }

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function showImages(array $data, int $id)
    {
        $category = $this->repository->show($id);

        return $this->showImagesHandler->handle($this->repository, $category, $data);
    }

    /**
     * @param array $data
     * @param int $id
     * @return array
     */
    public function showWithImages(array $data, int $id): array
    {
        $category = $this->repository->show($id);
        $paginateData = $this->repository->showImages($category, $data);

        return ['item' => $category, 'paginateData' => $paginateData];
    }

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function showExcludedImages(array $data, int $id)
    {
        $category = $this->repository->show($id);

        return $this->showExcludedImagesHandler->handle($this->repository, $category, $data);
    }

    /**
     * @param array $data
     * @param int $id
     * @return array
     */
    public function showWithExcludedImages(array $data, int $id): array
    {
        $category = $this->repository->show($id);
        $paginateData = $this->repository->showExcludedImages($category, $data);

        return ['item' => $category, 'paginateData' => $paginateData];
    }

    /**
     * @param FormRequest $request
     * @param int $id
     */
    public function addImages(FormRequest $request, int $id)
    {
        $category = $this->repository->show($id);
        $images = $request->toArray();
        $this->repository->addImages($category, $images);
    }

    /**
     * @param array $data
     * @param int $categoryId
     * @param int $imageId
     * @return mixed
     */
    public function removeImage(array $data, int $categoryId, int $imageId)
    {
        $category = $this->repository->show($categoryId);

        return $this->repository->removeImage($category, $imageId)
            ? $this->showImagesHandler->handle($this->repository, $category, $data)
            : abort(500);
    }
}
