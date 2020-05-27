<?php


namespace App\Services\Users;


use App\Models\User;
use App\Services\Users\Handlers\CreateUserHandler;
use App\Services\Users\Repositories\UsersRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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

    public function __construct(
        CreateUserHandler $createUserHandler,
        UsersRepositoryInterface $usersRepository
    )
    {
        $this->createUserHandler = $createUserHandler;
        $this->usersRepository = $usersRepository;
    }

    /**
     * @param int $id
     * @return User|null
     */
    public function findUser(int $id)
    {
        return $this->usersRepository->find($id);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function searchUsers(): LengthAwarePaginator
    {
        return $this->usersRepository->search();
    }

    /**
     * @param array $data
     * @return User
     */
    public function storeUser(array $data): User
    {
        $user = $this->createUserHandler->handle($data);

        // do some logic

        return $user;
    }

    /**
     * @param User $user
     * @param array $data
     * @return User
     */
    public function updateCountry(User $user, array $data): User
    {
        return $this->usersRepository->updateFromArray($user, $data);
    }
}
