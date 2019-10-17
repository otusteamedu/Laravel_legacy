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
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

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
     * @return Collection
     */
    public function getModerators(): Collection
    {
        $users = $this->userRepository->get();
        return $this->filterUsersOnlyGmail($moderatorUsers);
    }

    /**
     * @return int
     */
    public function getModeratorsCount(): int
    {
        $users = $this->userRepository->get();
        $moderatorUsers = $users->filter(function (User $user) {
            Str::ascii($user->name);
            return $user->isModerator();
        });
        return count($moderatorUsers);
    }

    /**
     * @return Collection
     */
    public function getUsersGroupedByLevel(): Collection
    {
        $users = $this->userRepository->get();
        return $users->groupBy('level');
    }

    /**
     * @return Collection
     */
    public function getUsersSortedByLevel(): Collection
    {
        $users = $this->userRepository->get();
        return $users->sortBy('level');
    }

    /**
     * @return array
     */
    public function getUsersSortedByLevelAsArray(): array
    {
        $users = $this->userRepository->get();
        return $users
            ->sortBy('level')
            ->toArray();
    }

    /**
     * @param Collection $users
     * @return Collection
     */
    public function filterUsersOnlyGmail(Collection $users): Collection
    {
        return $users->filter(function (User $user) {
            return strpos($user->email, '@otus.ru') !== false;
        });
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