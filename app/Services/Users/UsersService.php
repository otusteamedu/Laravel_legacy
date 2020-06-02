<?php


namespace App\Services\Users;


use App\Models\User;
use App\Services\Users\Handlers\CreateUserHandler;
use App\Services\Users\Repositories\UsersRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class UsersService
 * Сервис для работы с пользователями
 * @package App\Services\Users
 */
class UsersService
{

    /**
     * @var CreateUserHandler
     */
    private $createUserHandler;
    /**
     * @var UsersRepositoryInterface
     */
    private $usersRepository;

    /**
     * UsersService constructor.
     * @param CreateUserHandler        $createUserHandler
     * @param UsersRepositoryInterface $usersRepository
     */
    public function __construct(
        CreateUserHandler $createUserHandler,
        UsersRepositoryInterface $usersRepository
    )
    {
        $this->createUserHandler = $createUserHandler;
        $this->usersRepository = $usersRepository;
    }

    /**
     * Получить сущность пользователя
     * @param int $id
     * @return User|null
     */
    public function findUser(int $id)
    {
        return $this->usersRepository->find($id);
    }

    /**
     * Получить список пользователей
     * @param array $groups
     * @param int   $limit
     * @return LengthAwarePaginator
     */
    public function searchUsers(array $groups, $limit = 20): LengthAwarePaginator
    {
        return $this->usersRepository->search($groups, $limit);
    }

    /**
     * Создать пользователя
     * @param array $data
     * @return User
     */
    public function storeUser(array $data): User
    {
        $user = $this->createUserHandler->handle($data);
        return $user;
    }

    /**
     * Обновить данные пользователя
     * @param User $user
     * @param array $data
     * @return User
     */
    public function updateUser(User $user, array $data): User
    {
        // @todo checkPassword

        return $this->usersRepository->updateFromArray($user, $data);
    }

    /**
     * Удалить пользователя
     * @param User $user
     * @return mixed
     */
    public function deleteUser(User $user)
    {
        // @todo check current
        return $this->usersRepository->delete($user);
    }
}
