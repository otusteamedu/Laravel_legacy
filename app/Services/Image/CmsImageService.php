<?php


namespace App\Services\Image;


use App\Services\Base\Resource\CmsBaseResourceService;
use App\Services\Base\Resource\Handlers\ClearCacheByTagHandler;
use App\Services\Cache\Tag;
use App\Services\Image\Handlers\DeleteImageHandler;
use App\Services\Image\Handlers\GetItemsHandler;
use App\Services\Image\Handlers\SyncAssociativeCategoryOfImageHandler;
use App\Services\Image\Handlers\UpdateImagePathHandler;
use App\Services\Image\Handlers\UploadImageHandler;
use App\Services\Image\Repositories\CmsImageRepository;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class CmsImageService extends CmsBaseResourceService
{
    private UploadImageHandler $storeHandler;
    private UpdateImagePathHandler $updateItemPathHandler;
    private SyncAssociativeCategoryOfImageHandler $syncAssociativeCategoryHandler;
    private DeleteImageHandler $destroyHandler;
    private GetItemsHandler $getItemsHandler;

    public function __construct(
        CmsImageRepository $repository,
        ClearCacheByTagHandler $clearCacheByTagHandler,
        UploadImageHandler $uploadImageHandler,
        UpdateImagePathHandler $updateImagePathHandler,
        SyncAssociativeCategoryOfImageHandler $syncAssociativeCategoryOfImageHandler,
        DeleteImageHandler $deleteImageHandler,
        GetItemsHandler $getItemsHandler
    )
    {
        parent::__construct($repository, $clearCacheByTagHandler);
        $this->storeHandler = $uploadImageHandler;
        $this->updateItemPathHandler = $updateImagePathHandler;
        $this->syncAssociativeCategoryHandler = $syncAssociativeCategoryOfImageHandler;
        $this->destroyHandler = $deleteImageHandler;
        $this->getItemsHandler = $getItemsHandler;
        $this->cacheTag = Tag::IMAGES_TAG;
    }

    /**
     * @param array $pagination
     * @return mixed
     */
    public function getItems(array $pagination)
    {
        return $this->getItemsHandler->handle($pagination);
    }

    /**
     * @param int $id
     * @return JsonResource
     */
    public function getItemToEdit(int $id): JsonResource
    {
        return $this->repository->getItemToEdit($id);
    }

    /**
     * @param array $storeData
     * @return mixed
     */
    public function store(array $storeData)
    {
        $this->storeHandler->handle($storeData['images']);

        $pagination = Arr::except($storeData, ['images']);

        return $this->repository->getItems($pagination);
    }

    /**
     * @param int $id
     * @param array $updateData
     * @return mixed|void
     */
    public function update(int $id, array $updateData)
    {
        $image = $this->repository->getItem($id);

        $this->syncAssociativeCategoryHandler
            ->handle($image, 'topics', $updateData['topics'] ?? null);
        $this->syncAssociativeCategoryHandler
            ->handle($image, 'colors', $updateData['colors'] ?? null);
        $this->syncAssociativeCategoryHandler
            ->handle($image, 'interiors', $updateData['interiors'] ?? null);

        $this->repository
            ->syncAssociations($image, 'tags', $updateData['tags'] ?? null);

        if ($updateData['owner_id'] == 0) {
            $updateData['owner_id'] = null;
        }

        $this->repository
            ->fillAttributesFromArray($image, Arr::only($updateData, ['publish', 'owner_id', 'description']));

        Arr::has($updateData, 'image') && $this->updateItemPathHandler->handle($image, $updateData['image']);
    }

    /**
     * @param int $id
     * @return int
     * @throws \Exception
     */
    public function destroy(int $id): int
    {
        $image = $this->repository->getItem($id);

        return $this->destroyHandler->handle($image);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function publish(int $id)
    {
        $item = $this->repository->getItem($id);

        return $this->repository->publish($item);
    }
}
