<?php


namespace App\Services\Category;


use App\Http\Requests\FormRequest;
use App\Models\Category;
use App\Services\Category\Handlers\AddImagesToCategoryHandler;
use App\Services\Category\Handlers\CreateCategoryHandler;
use App\Services\Category\Handlers\DeleteCategoryHandler;
use App\Services\Category\Handlers\GetAllCategoryHandler;
use App\Services\Category\Handlers\GetCategoryExcludedImageListHandler;
use App\Services\Category\Handlers\GetCategoryHandler;
use App\Services\Category\Handlers\GetCategoryImageListHandler;
use App\Services\Category\Handlers\GetCategoryListByTypeHandler;
use App\Services\Category\Handlers\PublishCategoryHandler;
use App\Services\Category\Handlers\RemoveImageFromCategoryHandler;
use App\Services\Category\Handlers\UpdateCategoryHandler;
use App\Services\Category\Handlers\UploadImagesToCategoryHandler;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CategoryService
{
    private $storeHandler;
    private $updateHandler;
    private $indexHandler;
    private $showHandler;
    private $indexByTypeHandler;
    private $destroyHandler;
    private $publishHandler;
    private $getImageListHandler;
    private $getExcludedImageListHandler;
    private $uploadImagesToItemHandler;
    private $addImagesToItemHandler;
    private $removeImageFromItemHandler;

    public function __construct(
        GetAllCategoryHandler $getAllHandler,
        GetCategoryHandler $getItemHandler,
        GetCategoryListByTypeHandler $getListByTypeHandler,
        CreateCategoryHandler $createHandler,
        UpdateCategoryHandler $updateHandler,
        DeleteCategoryHandler $deleteHandler,
        PublishCategoryHandler $publishHandler,
        GetCategoryImageListHandler $getImageListHandler,
        GetCategoryExcludedImageListHandler $getExcludedImageListHandler,
        UploadImagesToCategoryHandler $uploadImagesToItemHandler,
        AddImagesToCategoryHandler $addImagesToItemHandler,
        RemoveImageFromCategoryHandler $removeImageFromItemHandler
    )
    {
        $this->storeHandler = $createHandler;
        $this->updateHandler = $updateHandler;
        $this->indexHandler = $getAllHandler;
        $this->showHandler = $getItemHandler;
        $this->indexByTypeHandler = $getListByTypeHandler;
        $this->destroyHandler = $deleteHandler;
        $this->publishHandler = $publishHandler;
        $this->getImageListHandler = $getImageListHandler;
        $this->getExcludedImageListHandler = $getExcludedImageListHandler;
        $this->uploadImagesToItemHandler = $uploadImagesToItemHandler;
        $this->addImagesToItemHandler = $addImagesToItemHandler;
        $this->removeImageFromItemHandler = $removeImageFromItemHandler;
    }

    /**
     * @return Collection
     */
    public function index(): Collection {
        return $this->indexHandler->handle();
    }

    /**
     * @param string $type
     * @return Collection
     */
    public function indexByType(string $type): Collection
    {
        return $this->indexByTypeHandler->handle($type);
    }

    /**
     * @param int $id
     * @return Category
     */
    public function show(int $id)
    {
        return $this->showHandler->handle($id);
    }

    /**
     * @param int $id
     * @return array
     */
    public function showWithImages(int $id): array
    {
        $category = $this->showHandler->handle($id);
        $images = $this->getImageListHandler->handle($category);

        return ['item' => $category, 'images' => $images];
    }

    /**
     * @param int $id
     * @return array
     */
    public function showWithExcludedImages(int $id): array
    {
        $category = $this->showHandler->handle($id);
        $images = $this->getExcludedImageListHandler->handle($category);

        return ['item' => $category, 'images' => $images];
    }

    /**
     * @param FormRequest $request
     * @return Category
     */
    public function store(FormRequest $request): Category
    {
        return $this->storeHandler->handle($request);
    }

    /**
     * @param FormRequest $request
     * @param int $id
     * @return Category
     */
    public function update(FormRequest $request, int $id): Category
    {
        $category = $this->showHandler->handle($id);

        return $this->updateHandler->handle($request, $category);
    }

    /**
     * @param int $id
     * @return int
     * @throws \Exception
     */
    public function destroy(int $id): int
    {
        $category = $this->showHandler->handle($id);

        return $this->destroyHandler->handle($category);
    }

    /**
     * @param int $id
     * @return Category
     */
    public function publish(int $id): Category
    {
        $category = $this->showHandler->handle($id);

        return $this->publishHandler->handle($category);
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function getImageList(int $id): Collection
    {
        $category = $this->showHandler->handle($id);

        return $this->getImageListHandler->handle($category);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Category
     *
     */
    public function upload(Request $request, int $id): Collection
    {
        $category = $this->showHandler->handle($id);
        $uploadImages = $request->file('images');
        $this->uploadImagesToItemHandler->handle($uploadImages, $category);

        return $this->getImageListHandler->handle($category);
    }

    /**
     * @param Request $request
     * @param int $id
     */
    public function addImages(Request $request, int $id)
    {
        $category = $this->showHandler->handle($id);
        $images = $request->toArray();

        $this->addImagesToItemHandler->handle($category, $images);
    }

    /**
     * @param int $categoryId
     * @param int $imageId
     * @return int
     */
    public function removeImage(int $categoryId, int $imageId): int
    {
        $category = $this->showHandler->handle($categoryId);

        return $this->removeImageFromItemHandler->handle($category, $imageId);
    }
}
