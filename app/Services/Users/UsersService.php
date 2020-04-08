<?php
/**
 * Сервис для работы с пользователями
 */

namespace App\Services\Users;

use App\Models\User;
use App\Services\Users\Handlers\CreateUserHandler;
use App\Services\Users\Handlers\UpdateUserHandler;
use App\Services\Users\Handlers\DeleteUserHandler;
use App\Services\Users\Repositories\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UsersService
{

    /** @var UserRepositoryInterface */
    private $repository;
    /** @var CreateUserHandler */
    private $createHandler;
    /** @var UpdateUserHandler */
    private $updateHandler;
    /** @var DeleteUserHandler */
    private $deleteHandler;

    public function __construct(
        CreateUserHandler $createUserHandler,
        UpdateUserHandler $updateUserHandler,
        DeleteUserHandler $deleteUserHandler,
        UserRepositoryInterface $userRepository
    )
    {
        $this->createHandler = $createUserHandler;
        $this->updateHandler = $updateUserHandler;
        $this->deleteHandler = $deleteUserHandler;
        $this->repository = $userRepository;
    }


    /**
     * Поиск и выдача результата с фильтром по почте и имени
     * @param string $search поисковая строка
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchByNameOrEmail($search): LengthAwarePaginator
    {
        return $this->repository->searchByNameOrEmail($search);
    }


    /**
     * Сохранение
     * @param array $data
     * @return User
     */
    public function store(array $data): User
    {
        return $this->createHandler->handle($data);
    }

    /**
     * Изменение
     * @param int $id
     * @param array $data
     * @return User
     */
    public function update(int $id, array $data): User
    {
        return $this->updateHandler->handle($id, $data);
    }

    /**
     * Удаление
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        return $this->deleteHandler->handle($id);
    }

    /**
     * Список уровней пользователей
     * @return array
     */
    public function getUserLevels()
    {
        return [
            \App\Models\User::LEVEL_USER => __('levels.user'),
            \App\Models\User::LEVEL_MODERATOR => __('levels.moderator'),
            \App\Models\User::LEVEL_ADMIN => __('levels.admin'),
        ];
    }
}
