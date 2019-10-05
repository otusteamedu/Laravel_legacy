<?php
/**
 * Description of UsersService.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Users;


use App\Models\User;
use App\Services\Users\Handlers\CreateUserHandler;
use App\Services\Users\Handlers\UpdateUserHandler;
use App\Services\Users\Repositories\UserRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class UsersService
{

    private $createUserHandler;
    private $updateUserHandler;
    /** @var UserRepository */
    private $userRepository;

    public function __construct(
        CreateUserHandler $createUserHandler,
        UpdateUserHandler $updateUserHandler,
        UserRepository $userRepository
    )
    {
        $this->createUserHandler = $createUserHandler;
        $this->updateUserHandler = $updateUserHandler;
        $this->userRepository = $userRepository;
    }

    /**
     * @param int $id
     * @return User|null
     */
    public function find(int $id): ?User
    {
        return $this->userRepository->find($id);
    }

    /**
     * @param array $filters
     * @param array $with
     * @return LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection
     */
    public function search(array $filters = [], array $with = []): LengthAwarePaginator
    {
        return $this->userRepository->search($filters, $with);
    }

    /**
     * @param array $data
     * @return User
     */
    public function createUser(array $data): User
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
        return $this->updateUserHandler->handle($user, $data);
    }

}