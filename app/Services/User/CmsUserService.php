<?php


namespace App\Services\User;


use App\Models\User;
use App\Services\Base\Resource\CmsBaseResourceService;
use App\Services\Base\Resource\Handlers\ClearCacheByTagHandler;
use App\Services\User\Handlers\CmsCreateHandler;
use App\Services\User\Handlers\UpdateHandler;
use App\Services\User\Repositories\CmsUserRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class CmsUserService extends CmsBaseResourceService
{
    /**
     * @var CmsCreateHandler
     */
    private CmsCreateHandler $storeHandler;

    /**
     * @var UpdateHandler
     */
    private UpdateHandler $updateHandler;

    /**
     * UserServiceCms constructor.
     * @param CmsUserRepository $repository
     * @param ClearCacheByTagHandler $clearCacheByTagHandler
     * @param CmsCreateHandler $createUserHandler
     * @param UpdateHandler $updateUserHandler
     */
    public function __construct(
        CmsUserRepository $repository,
        ClearCacheByTagHandler $clearCacheByTagHandler,
        CmsCreateHandler $createUserHandler,
        UpdateHandler $updateUserHandler
    )
    {
        parent::__construct($repository, $clearCacheByTagHandler);
        $this->repository = $repository;
        $this->storeHandler = $createUserHandler;
        $this->updateHandler = $updateUserHandler;
    }

    /**
     * @param int $id
     * @return JsonResource
     */
    public function getItemWithRole(int $id): JsonResource
    {
        return $this->repository->getItemWithRole($id);
    }

    /**
     * @param array $storeData
     * @return User
     */
    public function store(array $storeData): User
    {
        return $this->storeHandler->handle($storeData);
    }

    /**
     * @param array $updateData
     * @param int $id
     * @return User
     */
    public function update(int $id, array $updateData): User
    {
        $user = $this->repository->getItem($id);

        return $this->updateHandler->handle($user, $updateData);
    }
}
