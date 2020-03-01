<?php


namespace App\Services\Texture;


use App\Http\Requests\FormRequest;
use App\Models\Texture;
use App\Services\Base\Resource\CmsBaseResourceService;
use App\Services\Base\Resource\Handlers\ClearCacheByTagHandler;
use App\Services\Texture\Repositories\TextureRepositoryCms;
use App\Services\Texture\Handlers\CreateTextureHandler;
use App\Services\Texture\Handlers\DeleteTextureHandler;
use App\Services\Texture\Handlers\UpdateTextureHandler;

class TextureServiceCms extends CmsBaseResourceService
{
    private $storeHandler;
    private $updateHandler;
    private $destroyHandler;

    /**
     * TextureServiceCms constructor.
     * @param TextureRepositoryCms $repository
     * @param ClearCacheByTagHandler $clearCacheByTagHandler
     * @param CreateTextureHandler $createTextureHandler
     * @param UpdateTextureHandler $updateTextureHandler
     * @param DeleteTextureHandler $deleteTextureHandler
     */
    public function __construct(
        TextureRepositoryCms $repository,
        ClearCacheByTagHandler $clearCacheByTagHandler,
        CreateTextureHandler $createTextureHandler,
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
     * @param FormRequest $request
     * @return Texture
     */
    public function store(FormRequest $request): Texture
    {
        return $this->storeHandler->handle($request->all());
    }

    /**
     * @param FormRequest $request
     * @param int $id
     * @return Texture
     */
    public function update(FormRequest $request, int $id): Texture
    {
        $item = $this->repository->show($id);

        return $this->updateHandler->handle($request->all(), $item);
    }

    /**
     * @param int $id
     * @return int
     * @throws \Exception
     */
    public function delete(int $id): int
    {
        $item = $this->repository->show($id);

        return $this->destroyHandler->handle($item);
    }
}
