<?php


namespace App\Services\Base\Category;


use App\Http\Requests\FormRequest;
use App\Services\Base\Category\Repositories\BaseCategoryRepository;
use App\Services\Base\Resource\BaseResourceService;
use App\Services\Base\Category\Handlers\UploadHandler;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseCategoryService extends BaseResourceService
{
    /**
     * @var BaseCategoryRepository
     */
    protected $repository;

    /**
     * @var UploadHandler
     */
    protected $uploadHandler;

    /**
     * BaseCategoryService constructor.
     * @param BaseCategoryRepository $repository
     * @param UploadHandler $uploadHandler
     */
    public function __construct(
        BaseCategoryRepository $repository,
        UploadHandler $uploadHandler
    )
    {
        parent::__construct($repository);
        $this->uploadHandler = $uploadHandler;
    }

    /**
     * @param FormRequest $request
     * @param int $id
     * @return Collection
     */
    public function upload(FormRequest $request, int $id): Collection
    {
        $category = $this->repository->show($id);
        $uploadImages = $request->file('images');
        $this->uploadHandler->handle($uploadImages, $this->repository, $category);

        return $this->repository->getImageList($category);
    }

    /**
     * @param int $id
     * @return array
     */
    public function showWithImages(int $id): array
    {
        $category = $this->repository->show($id);
        $images = $this->repository->getImageList($category);

        return ['item' => $category, 'images' => $images];
    }

    /**
     * @param int $id
     * @return array
     */
    public function showWithExcludedImages(int $id): array
    {
        $category = $this->repository->show($id);
        $images = $this->repository->getExcludedImageList($category);

        return ['item' => $category, 'images' => $images];
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function getImageList(int $id): Collection
    {
        $category = $this->repository->show($id);

        return $this->repository->getImageList($category);
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
     * @param int $categoryId
     * @param int $imageId
     * @return int
     */
    public function removeImage(int $categoryId, int $imageId): int
    {
        $category = $this->repository->show($categoryId);

        return $this->repository->removeImage($category, $imageId);
    }
}
