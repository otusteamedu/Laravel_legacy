<?php


namespace App\Services\Users;


use App\Builders\QueryBuilder;
use App\Jobs\Queue;
use App\Mail\Clients\InviteMail;
use App\Models\User;
use App\Services\Users\Exceptions\IncorrectUserException;
use App\Services\Users\Handlers\CreateUserHandler;
use App\Services\Users\Repositories\UsersRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class UsersService
 * Сервис для работы с пользователями
 *
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
     *
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
     *
     * @param int $id
     *
     * @return User|null
     */
    public function findUser(int $id)
    {
        return $this->usersRepository->find($id);
    }

    /**
     * Получить список пользователей
     *
     * @param array $groups
     * @param int   $limit
     *
     * @return LengthAwarePaginator
     */
    public function searchUsers(array $groups, $limit = 20): LengthAwarePaginator
    {
        return $this->usersRepository->search($groups, $limit);
    }

    /**
     * Получить список проектов
     *
     * @param QueryBuilder $builder
     *
     * @return Collection
     */
    public function getAll(QueryBuilder $builder): Collection
    {
        return $this->usersRepository->getBy($builder);
    }

    /**
     * Создать пользователя
     *
     * @param array $data
     *
     * @return User
     */
    public function storeUser(array $data): User
    {
        $user = $this->createUserHandler->handle($data);
        return $user;
    }

    /**
     * Обновить данные пользователя
     *
     * @param User  $user
     * @param array $data
     *
     * @return User
     */
    public function updateUser(User $user, array $data): User
    {
        // @todo checkPassword

        return $this->usersRepository->updateFromArray($user, $data);
    }

    /**
     * Удалить пользователя
     *
     * @param User $user
     *
     * @return bool|null
     */
    public function deleteUser(User $user): ?bool
    {
        if (Auth::id() == $user->id) {
            throw new IncorrectUserException();
        }

        return $this->usersRepository->delete($user);
    }

    /**
     * Обновить e-mail пользователя
     *
     * @param User   $user
     * @param string $email
     *
     * @return User
     */
    public function updateUserEmail(User $user, string $email): User
    {
        return $this->usersRepository->updateEmail($user, $email);
    }

    /**
     * Обновить пароль пользователя
     *
     * @param User   $user
     * @param string $password
     *
     * @return User
     */
    public function updateUserrPassword(User $user, string $password): User
    {
        return $this->usersRepository->updatePassword($user, $password);
    }

    /**
     * Пригласить нового клиента
     *
     * @param DTO\User $userDTO
     *
     * @return User
     */
    public function sendInviteClient(DTO\User $userDTO): User
    {
        $user = $this->usersRepository->register($userDTO);

        Mail::to($user)->queue(
            (new InviteMail($user))->onQueue(Queue::EMAILS)
        );

        return $user;
    }

    /**
     * Отправить ссылку на востановление пароля
     *
     * @param User $user
     *
     * @return bool
     * @throws IncorrectUserException
     */
    public function sendRecoveryEmail(User $user)
    {
        $result = $this->usersRepository->sendRecoveryEmail($user);

        switch ($result) {
            case Password::INVALID_TOKEN:
            case Password::INVALID_USER:
                throw new IncorrectUserException();
            break;
            case Password::RESET_LINK_SENT:
                return true;
            break;
            default:
                throw new \Exception("Undefined result: " . $result);
            break;
        }
    }
}
