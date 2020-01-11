<?php


namespace App\Services\Texture;


use App\Http\Requests\FormRequest;
use App\Models\Texture;
use App\Services\Resource\ResourceService;
use App\Services\Texture\Repositories\TextureRepository;
use App\Services\Texture\Handlers\CreateTextureHandler;
use App\Services\Texture\Handlers\DeleteTextureHandler;
use App\Services\Texture\Handlers\UpdateTextureHandler;

class TextureService extends ResourceService
{
    private $storeHandler;
    private $updateHandler;
    private $destroyHandler;

    /**
     * TextureService constructor.
     * @param TextureRepository $repository
     * @param CreateTextureHandler $createTextureHandler
     * @param UpdateTextureHandler $updateTextureHandler
     * @param DeleteTextureHandler $deleteTextureHandler
     */
    public function __construct(
        TextureRepository $repository,
        CreateTextureHandler $createTextureHandler,
        UpdateTextureHandler $updateTextureHandler,
        DeleteTextureHandler $deleteTextureHandler
    )
    {
        parent::__construct($repository);
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
