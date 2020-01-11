<?php


namespace App\Services\User;


use App\Http\Requests\FormRequest;
use App\Models\User;
use App\Services\User\Handlers\CreateUserHandler;
use App\Services\User\Handlers\UpdateUserHandler;
use App\Services\User\Repositories\UserRepository;
use App\Services\Resource\ResourceService;
use Illuminate\Http\Resources\Json\JsonResource;

class UserService extends ResourceService
{
    private $storeHandler;
    private $updateHandler;

    public function __construct(
        UserRepository $repository,
        CreateUserHandler $createUserHandler,
        UpdateUserHandler $updateUserHandler
    )
    {
        parent::__construct($repository);
        $this->storeHandler = $createUserHandler;
        $this->updateHandler = $updateUserHandler;
    }

    /**
     * @param int $id
     * @return JsonResource
     */
    public function show(int $id): JsonResource
    {
        return $this->repository->showWithRole($id);
    }

    /**
     * @param FormRequest $request
     * @return User
     */
    public function store(FormRequest $request): User
    {
        return $this->storeHandler->handle($request);
    }

    /**
     * @param FormRequest $request
     * @param int $id
     * @return User
     */
    public function update(FormRequest $request, int $id): User
    {
        $user = $this->repository->show($id);

        return $this->updateHandler->handle($request, $user);
    }
}
