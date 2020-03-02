<?php


namespace App\Services\Image;


use App\Http\Requests\FormRequest;
use App\Services\Base\Resource\CmsBaseResourceService;
use App\Services\Base\Resource\Handlers\ClearCacheByTagHandler;
use App\Services\Image\Handlers\DeleteImageHandler;
use App\Services\Image\Handlers\IndexHandler;
use App\Services\Image\Handlers\SyncAssociativeCategoryOfImageHandler;
use App\Services\Image\Handlers\UpdateImagePathHandler;
use App\Services\Image\Handlers\UploadImageHandler;
use App\Services\Image\Repositories\CmsImageRepository;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Cache;

class CmsImageService extends CmsBaseResourceService
{
    private UploadImageHandler $storeHandler;
    private UpdateImagePathHandler $updateItemPathHandler;
    private SyncAssociativeCategoryOfImageHandler $syncAssociativeCategoryHandler;
    private DeleteImageHandler $destroyHandler;
    private IndexHandler $indexHandler;

    public function __construct(
        CmsImageRepository $repository,
        ClearCacheByTagHandler $clearCacheByTagHandler,
        UploadImageHandler $uploadImageHandler,
        UpdateImagePathHandler $updateImagePathHandler,
        SyncAssociativeCategoryOfImageHandler $syncAssociativeCategoryOfImageHandler,
        DeleteImageHandler $deleteImageHandler,
        IndexHandler $indexHandler
    )
    {
        parent::__construct($repository, $clearCacheByTagHandler);
        $this->storeHandler = $uploadImageHandler;
        $this->updateItemPathHandler = $updateImagePathHandler;
        $this->syncAssociativeCategoryHandler = $syncAssociativeCategoryOfImageHandler;
        $this->destroyHandler = $deleteImageHandler;
        $this->indexHandler = $indexHandler;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function paginateIndex(array $data)
    {
        return $this->indexHandler->handle($this->repository, $data);
    }

    /**
     * @param int $id
     * @return JsonResource
     */
    public function show(int $id): JsonResource
    {
        return $this->repository->showDetailed($id);
    }

    /**
     * @param FormRequest $request
     * @return mixed
     */
    public function store(FormRequest $request)
    {
        Cache::tags('images')->flush();

        $this->storeHandler->handle($request->file('images'));

        return $this->repository->paginateIndex($request->except('images'));
    }

    /**
     * @param FormRequest $request
     * @param int $id
     */
    public function update(FormRequest $request, int $id)
    {
        $image = $this->repository->show($id);

        $this->syncAssociativeCategoryHandler->handle('topics', $request->topics, $image);
        $this->syncAssociativeCategoryHandler->handle('colors', $request->colors, $image);
        $this->syncAssociativeCategoryHandler->handle('interiors', $request->interiors, $image);

        $this->repository->syncAssociations('tags', $request->tags, $image);

        $request['owner_id'] = +$request['owner_id'] !== 0
            ? $request['owner_id']
            : null;

        $this->repository->fillAttributesFromArray(
            $request->only(['publish', 'owner_id', 'description']),
            $image
        );

        $imageFile = $request->file('image');
        if ($imageFile) {
            $this->updateItemPathHandler->handle($imageFile, $image);
        }

        Cache::tags('images')->flush();
    }

    /**
     * @param int $id
     * @return int
     * @throws \Exception
     */
    public function destroy(int $id): int
    {
        $image = $this->repository->show($id);

        Cache::tags('images')->flush();

        return $this->destroyHandler->handle($image);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function publish(int $id)
    {
        $item = $this->repository->show($id);

        Cache::tags('images')->flush();

        return $this->repository->publish($item);
    }
}
