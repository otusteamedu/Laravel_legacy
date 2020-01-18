<?php


namespace App\Services\Image;


use App\Http\Requests\FormRequest;
use App\Services\Base\Resource\BaseResourceService;
use App\Services\Image\Handlers\DeleteImageHandler;
use App\Services\Image\Handlers\SyncAssociativeCategoryOfImageHandler;
use App\Services\Image\Handlers\UpdateImagePathHandler;
use App\Services\Image\Handlers\UploadImageHandler;
use App\Services\Image\Repositories\ImageRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageService extends BaseResourceService
{
    private $storeHandler;
    private $updateItemPathHandler;
    private $syncAssociativeCategoryHandler;
    private $destroyHandler;

    public function __construct(
        ImageRepository $repository,
        UploadImageHandler $uploadImageHandler,
        UpdateImagePathHandler $updateImagePathHandler,
        SyncAssociativeCategoryOfImageHandler $syncAssociativeCategoryOfImageHandler,
        DeleteImageHandler $deleteImageHandler
    )
    {
        parent::__construct($repository);
        $this->storeHandler = $uploadImageHandler;
        $this->updateItemPathHandler = $updateImagePathHandler;
        $this->syncAssociativeCategoryHandler = $syncAssociativeCategoryOfImageHandler;
        $this->destroyHandler = $deleteImageHandler;
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
     * @return Collection
     */
    public function store(FormRequest $request): Collection
    {
        $this->storeHandler->handle($request);

        return $this->repository->index();
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

        $this->repository->fillAttributesFromArray(
            $request->only(['publish', 'owner_id', 'description']),
            $image
        );

        $imageFile = $request->file('image');
        if ($imageFile) {
            $this->updateItemPathHandler->handle($imageFile, $image);
        }
    }

    /**
     * @param int $id
     * @return int
     * @throws \Exception
     */
    public function destroy(int $id): int
    {
        $image = $this->repository->show($id);

        return $this->destroyHandler->handle($image);
    }

    /**
     * @param FormRequest $request
     * @return array
     */
    public function upload(FormRequest $request): array
    {
        return $this->storeHandler->handle($request);
    }
}
