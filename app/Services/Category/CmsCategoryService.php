<?php


namespace App\Services\Category;


use App\Services\Base\Category\CmsBaseCategoryService;
use App\Services\Base\Category\Handlers\GetExcludedImagesHandler;
use App\Services\Base\Category\Handlers\GetImagesHandler;
use App\Services\Base\Resource\Handlers\ClearCacheByTagHandler;
use App\Services\Category\Handlers\DestroyHandler;
use App\Services\Category\Handlers\StoreHandler;
use App\Services\Category\Handlers\UpdateHandler;
use App\Services\Base\Category\Handlers\UploadHandler;
use App\Services\Category\Repositories\CmsCategoryRepository;
use Illuminate\Database\Eloquent\Collection;

class CmsCategoryService extends CmsBaseCategoryService
{
    private StoreHandler $storeHandler;

    private UpdateHandler $updateHandler;

    private DestroyHandler $destroyHandler;

    /**
     * CmsCategoryService constructor.
     * @param CmsCategoryRepository $repository
     * @param ClearCacheByTagHandler $clearCacheByTagHandler
     * @param UploadHandler $uploadHandler
     * @param GetImagesHandler $showImagesHandler
     * @param GetExcludedImagesHandler $showExcludedImagesHandler
     * @param StoreHandler $storeHandler
     * @param UpdateHandler $updateHandler
     * @param DestroyHandler $destroyHandler
     */
    public function __construct(
        CmsCategoryRepository $repository,
        ClearCacheByTagHandler $clearCacheByTagHandler,
        UploadHandler $uploadHandler,
        GetImagesHandler $showImagesHandler,
        GetExcludedImagesHandler $showExcludedImagesHandler,
        StoreHandler $storeHandler,
        UpdateHandler $updateHandler,
        DestroyHandler $destroyHandler
    )
    {
        parent::__construct(
            $repository,
            $clearCacheByTagHandler,
            $uploadHandler,
            $showImagesHandler,
            $showExcludedImagesHandler
        );
        $this->storeHandler = $storeHandler;
        $this->updateHandler = $updateHandler;
        $this->destroyHandler = $destroyHandler;
    }

    /**
     * @param string $type
     * @return Collection
     */
    public function getItemsByType(string $type): Collection
    {
        return $this->repository->getItemsByType($type);
    }

    /**
     * @param array $storeData
     * @return mixed
     */
    public function store(array $storeData)
    {
        return $this->storeHandler->handle($storeData);
    }

    /**
     * @param int $id
     * @param array $updateData
     * @return mixed
     */
    public function update(int $id, array $updateData)
    {
        $category = $this->repository->getItem($id);

        return $this->updateHandler->handle($category, $updateData);
    }

    /**
     * @param int $id
     * @return int
     * @throws \Exception
     */
    public function destroy(int $id): int
    {
        $category = $this->repository->show($id);

        return $this->destroyHandler->handle($category);
    }
}
