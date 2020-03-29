<?php

namespace App\Services\Users;


use App\Models\User;
use App\Services\Users\Handlers\CreateUserHandler;
use App\Services\Users\Handlers\UpdateUserHandler;
use App\Services\Users\Handlers\DeleteUserHandler;
use App\Services\Users\Repositories\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Services\Pictures\Resolvers\PictureIdByUploadedFileResolver;

class UsersService
{
    private $createUserHandler;
    private $updateUserHandler;
    private $deleteUserHandler;
    private $userRepository;
    private $pictureIdByUploadedFileResolver;

    public function __construct(
        CreateUserHandler $createUserHandler,
        UpdateUserHandler $updateUserHandler,
        DeleteUserHandler $deleteUserHandler,
        UserRepositoryInterface $userRepository,
        PictureIdByUploadedFileResolver $pictureIdByUploadedFileResolver
    )
    {
        $this->createUserHandler = $createUserHandler;
        $this->updateUserHandler = $updateUserHandler;
        $this->deleteUserHandler = $deleteUserHandler;
        $this->userRepository = $userRepository;
        $this->pictureIdByUploadedFileResolver = $pictureIdByUploadedFileResolver;
    }

    /**
     * @param int $id
     * @return User|null
     */
    public function findUser(int $id)
    {
        return $this->userRepository->find($id);
    }

    /**
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function searchUsers(array $filters): LengthAwarePaginator
    {
        return $this->userRepository->search($filters);
    }

    /**
     * @param array $data
     * @return User
     */
    public function storeUser(array $data): User
    {
        return $this->createUserHandler->handle($data);
    }

    /**
     * @param User $user
     * @param array $data
     * @return User
     */
    public function updateUser(User $user, array $data): User
    {
        if (!empty($data['avatar_uploaded_file'])) {
            $data['picture_id'] = $this->pictureIdByUploadedFileResolver->resolve($data['avatar_uploaded_file']);
            unset($data['avatar_uploaded_file']);
        }

        return $this->updateUserHandler->handle($user, $data);
    }

    /**
     * @param User $user
     */
    public function deleteUser(User $user) {
        return $this->deleteUserHandler->handle($user);
    }
}
