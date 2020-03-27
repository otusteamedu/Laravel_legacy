<?php


namespace App\Services\Category;


use App\Http\Requests\FormRequest;
use App\Services\Base\Category\BaseCategoryService;
use App\Services\Category\Handlers\DestroyHandler;
use App\Services\Category\Handlers\StoreHandler;
use App\Services\Category\Handlers\UpdateHandler;
use App\Services\Base\Category\Handlers\UploadHandler;
use App\Services\Category\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;

class CategoryService extends BaseCategoryService
{
    /**
     * @var StoreHandler
     */
    private $storeHandler;

    /**
     * @var UpdateHandler
     */
    private $updateHandler;

    /**
     * @var DestroyHandler
     */
    private $destroyHandler;

    /**
     * CategoryService constructor.
     * @param CategoryRepository $repository
     * @param UploadHandler $uploadHandler
     * @param StoreHandler $storeHandler
     * @param UpdateHandler $updateHandler
     * @param DestroyHandler $destroyHandler
     */
    public function __construct(
        CategoryRepository $repository,
        UploadHandler $uploadHandler,
        StoreHandler $storeHandler,
        UpdateHandler $updateHandler,
        DestroyHandler $destroyHandler
    )
    {
        parent::__construct($repository, $uploadHandler);
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
