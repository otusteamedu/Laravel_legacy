<?php


namespace App\Services\Texture;


use App\Models\Texture;
use App\Services\Base\Resource\CmsBaseResourceService;
use App\Services\Base\Resource\Handlers\ClearCacheByTagHandler;
use App\Services\Texture\Repositories\CmsTextureRepository;
use App\Services\Texture\Handlers\StoreTextureHandler;
use App\Services\Texture\Handlers\DeleteTextureHandler;
use App\Services\Texture\Handlers\UpdateTextureHandler;

class CmsTextureService extends CmsBaseResourceService
{
    private StoreTextureHandler $storeHandler;
    private UpdateTextureHandler $updateHandler;
    private DeleteTextureHandler $destroyHandler;

    /**
     * TextureServiceCms constructor.
     * @param CmsTextureRepository $repository
     * @param ClearCacheByTagHandler $clearCacheByTagHandler
     * @param StoreTextureHandler $createTextureHandler
     * @param UpdateTextureHandler $updateTextureHandler
     * @param DeleteTextureHandler $deleteTextureHandler
     */
    public function __construct(
        CmsTextureRepository $repository,
        ClearCacheByTagHandler $clearCacheByTagHandler,
        StoreTextureHandler $createTextureHandler,
        UpdateTextureHandler $updateTextureHandler,
        DeleteTextureHandler $deleteTextureHandler
    )
    {
        parent::__construct($repository, $clearCacheByTagHandler);
        $this->storeHandler = $createTextureHandler;
        $this->updateHandler = $updateTextureHandler;
        $this->destroyHandler = $deleteTextureHandler;
    }

    /**
     * @param array $storeData
     * @return Texture
     */
    public function store(array $storeData): Texture
    {
        return $this->storeHandler->handle($storeData);
    }

    /**
     * @param int $id
     * @param array $updateData
     * @return Texture
     */
    public function update(int $id, array $updateData): Texture
    {
        $item = $this->repository->getItem($id);

        return $this->updateHandler->handle($item, $updateData);
    }

    /**
     * @param int $id
     * @return int
     * @throws \Exception
     */
    public function delete(int $id): int
    {
        $item = $this->repository->getItem($id);

        return $this->destroyHandler->handle($item);
    }
}
