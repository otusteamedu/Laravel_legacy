<?php


namespace App\Services\Category;


use App\Http\Requests\FormRequest;
use App\Services\Base\Category\BaseCategoryService;
use App\Services\Base\Category\Handlers\ShowExcludedImagesHandler;
use App\Services\Base\Category\Handlers\ShowImagesHandler;
use App\Services\Category\Handlers\DestroyHandler;
use App\Services\Category\Handlers\StoreHandler;
use App\Services\Category\Handlers\UpdateHandler;
use App\Services\Base\Category\Handlers\UploadHandler;
use App\Services\Category\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;

class CategoryService extends BaseCategoryService
{
    private StoreHandler $storeHandler;

    private UpdateHandler $updateHandler;

    private DestroyHandler $destroyHandler;

    /**
     * CategoryService constructor.
     * @param CategoryRepository $repository
     * @param UploadHandler $uploadHandler
     * @param ShowImagesHandler $showImagesHandler
     * @param ShowExcludedImagesHandler $showExcludedImagesHandler
     * @param StoreHandler $storeHandler
     * @param UpdateHandler $updateHandler
     * @param DestroyHandler $destroyHandler
     */
    public function __construct(
        CategoryRepository $repository,
        UploadHandler $uploadHandler,
        ShowImagesHandler $showImagesHandler,
        ShowExcludedImagesHandler $showExcludedImagesHandler,
        StoreHandler $storeHandler,
        UpdateHandler $updateHandler,
        DestroyHandler $destroyHandler
    )
    {
        parent::__construct(
            $repository,
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
    public function indexByType(string $type): Collection
    {
        return $this->repository->indexByType($type);
    }

    /**
     * @param FormRequest $request
     * @return mixed
     */
    public function store(FormRequest $request)
    {
        return $this->storeHandler->handle($request, $this->repository);
    }

    /**
     * @param FormRequest $request
     * @param int $id
     * @return mixed
     */
    public function update(FormRequest $request, int $id)
    {
        $category = $this->repository->show($id);

        return $this->updateHandler->handle($request, $this->repository, $category);
    }

    /**
     * @param int $id
     * @return int
     * @throws \Exception
     */
    public function destroy(int $id): int
    {
        $category = $this->repository->show($id);

        return $this->destroyHandler->handle($category, $this->repository);
    }
}
