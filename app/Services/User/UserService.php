<?php


namespace App\Services\User;


use App\Http\Requests\FormRequest;
use App\Models\User;
use App\Services\Base\Resource\CmsBaseResourceService;
use App\Services\Base\Resource\Handlers\ClearCacheByTagHandler;
use App\Services\User\Handlers\StoreUserHandler;
use App\Services\User\Handlers\UpdateUserHandler;
use App\Services\User\Repositories\UserRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class UserService extends CmsBaseResourceService
{
    /**
     * @var StoreUserHandler
     */
    private StoreUserHandler $storeHandler;

    /**
     * @var UpdateUserHandler
     */
    private UpdateUserHandler $updateHandler;

    /**
     * UserServiceCms constructor.
     * @param UserRepository $repository
     * @param ClearCacheByTagHandler $clearCacheByTagHandler
     * @param StoreUserHandler $createUserHandler
     * @param UpdateUserHandler $updateUserHandler
     */
    public function __construct(
        UserRepository $repository,
        ClearCacheByTagHandler $clearCacheByTagHandler,
        StoreUserHandler $createUserHandler,
        UpdateUserHandler $updateUserHandler
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

    /**
     * @param array $storeData
     * @param string $service
     * @return User
     */
    public function storeWithSocial(array $storeData, string $service): User
    {
        $user = $this->store($storeData);

        if (!$user->hasSocialLinked($service)) {
            $this->storeUserSocial($user, $storeData['social_id'], $service);
        }

        return $user;
    }

    /**
     * @param User $user
     * @param string $socialId
     * @param string $service
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function storeUserSocial(User $user, string $socialId, string $service)
    {
        return $this->repository->storeUserSocial($user, $socialId, $service);
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function getUserBySocialId(string $id)
    {
        return $this->repository->getUserBySocialId($id);
    }

    /**
     * @param string $email
     * @return mixed
     */
    public function getUserByEmail(string $email)
    {
        return $this->repository->getUserByEmail($email);
    }
}
