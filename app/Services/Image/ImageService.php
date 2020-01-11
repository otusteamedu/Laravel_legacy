<?php


namespace App\Services\Image;


use App\Http\Requests\FormRequest;
use App\Models\Image;
use App\Services\Image\Handlers\DeleteImageHandler;
use App\Services\Image\Handlers\FillAttributesOfImageHandler;
use App\Services\Image\Handlers\GetAllImagesHandler;
use App\Services\Image\Handlers\GetImageDetailedHandler;
use App\Services\Image\Handlers\GetImageHandler;
use App\Services\Image\Handlers\PublishImageHandler;
use App\Services\Image\Handlers\SyncAssociationsOfImageHandler;
use App\Services\Image\Handlers\SyncAssociativeCategoryOfImageHandler;
use App\Services\Image\Handlers\UpdateImagePathHandler;
use App\Services\Image\Handlers\UploadImageHandler;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageService
{
    private $indexHandler;
    private $showHandler;
    private $showDetailedHandler;
    private $storeHandler;
    private $updateItemPathHandler;
    private $syncAssociativeCategoryHandler;
    private $syncAssociationsHandler;
    private $fillAttributesHandler;
    private $destroyHandler;
    private $publishHandler;

    public function __construct(
        GetAllImagesHandler $getAllImagesHandler,
        GetImageHandler $getImageHandler,
        GetImageDetailedHandler $getImageDetailedHandler,
        UploadImageHandler $uploadImageHandler,
        UpdateImagePathHandler $updateImagePathHandler,
        SyncAssociativeCategoryOfImageHandler $syncAssociativeCategoryOfImageHandler,
        SyncAssociationsOfImageHandler $syncAssociationsOfImageHandler,
        FillAttributesOfImageHandler $fillAttributesOfImageHandler,
        DeleteImageHandler $deleteImageHandler,
        PublishImageHandler $publishImageHandler
    )
    {
        $this->indexHandler = $getAllImagesHandler;
        $this->showHandler = $getImageHandler;
        $this->showDetailedHandler = $getImageDetailedHandler;
        $this->storeHandler = $uploadImageHandler;
        $this->updateItemPathHandler = $updateImagePathHandler;
        $this->syncAssociativeCategoryHandler = $syncAssociativeCategoryOfImageHandler;
        $this->syncAssociationsHandler = $syncAssociationsOfImageHandler;
        $this->fillAttributesHandler = $fillAttributesOfImageHandler;
        $this->destroyHandler = $deleteImageHandler;
        $this->publishHandler = $publishImageHandler;
    }

    /**
     * @return Collection
     */
    public function index(): Collection {
        return $this->indexHandler->handle();
    }

    /**
     * @param int $id
     * @return JsonResource
     */
    public function show(int $id): JsonResource {
        return $this->showDetailedHandler->handle($id);
    }

    /**
     * @param Request $request
     * @return Collection
     */
    public function store(Request $request): Collection {
        $this->storeHandler->handle($request);

        return $this->indexHandler->handle();
    }

    /**
     * @param FormRequest $request
     * @param int $id
     */
    public function update(FormRequest $request, int $id) {
        $image = $this->showHandler->handle($id);

        $this->syncAssociativeCategoryHandler->handle('topics', $request->topics, $image);
        $this->syncAssociativeCategoryHandler->handle('colors', $request->colors, $image);
        $this->syncAssociativeCategoryHandler->handle('interiors', $request->interiors, $image);

        $this->syncAssociationsHandler->handle('tags', $request->tags, $image);

        $this->fillAttributesHandler->handle(
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
    public function destroy(int $id): int {
        $image = $this->showHandler->handle($id);

        return $this->destroyHandler->handle($image);
    }

    /**
     * @param int $id
     * @return Image
     */
    public function publish(int $id): Image {
        $image = $this->showHandler->handle($id);

        return $this->publishHandler->handle($image);
    }
}
