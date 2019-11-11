<?php
namespace App\Services\User;

use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserService
{

    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Получаем список пользователей
     * @return mixed
     */
    public function getUsers(): Collection
    {
        $users = $this->userRepository->getAll();

        return $users;
    }

    /**
     * Получаем текущего авторизированного пользователя
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function getCurrentUser(): ?\App\Models\User\User
    {
        $currentUser = Auth::user();

        return $currentUser;
    }

    /**
     * Создаем нового пользователя
     * @param $data
     * @return mixed
     */
    public function createUser(array $data): ?\App\Models\User\User
    {
        $user = $this->userRepository->add($data);
        return $user;
    }

    /**
     * Активируем пользователя
     * @param $userId
     * @return bool
     */
    public function activate(int $userId): void
    {
        $this->userRepository->activate($userId);
    }

    /**
     * Деактивируем пользователя
     * @param $userId
     * @return bool
     */
    public function unactivate(int $userId): void
    {
        $this->userRepository->deactivate($userId);
    }

    /**
     * Получаем пользователя по ID
     * @param int $userId
     * @return User|null
     */
    public function getUserById(int $userId): ?\App\Models\User\User
    {
        $user = $this->userRepository->getById($userId);
        return $user;
    }

    /**
     * Оедактирование имени пользователя
     * @param int $userId
     * @param string $newFirstName
     * @return bool
     */
    public function editFirstName(int $userId, string $newFirstName): void
    {
        $this->userRepository->update($userId, ['first_name' => $newFirstName]);
    }

    /**
     * Реактироание фамилии пользователя
     * @param int $userId
     * @param string $newLastName
     * @return bool
     */
    public function editLastName(int $userId, string $newLastName): void
    {
        $this->userRepository->update($userId, ['last_name' => $newLastName]);
    }

    /**
     * Редактирование дня рождения
     * @param $userId
     * @param $newBirthday
     * @return bool
     */
    public function editBirthday(int $userId, string $newBirthday): void
    {
        $this->userRepository->update($userId, ['birthday' => $newBirthday]);
    }

    /**
     * Редактирование роли
     * @param $userId
     * @param $newRoleId
     * @return bool
     */
    public function editRole(int $userId, int $newRoleId): void
    {
        $this->userRepository->update($userId, ['role_id' => $newRoleId]);
    }

    /**
     * Удаление пользователя
     * @param $userId
     * @return bool
     */
    public function destroy(int $userId): void
    {
        $this->userRepository->delete($userId);
    }

    /**
     * Изменение пароля пользователя
     * @param int $userId
     * @param string $newPassword
     * @return bool
     */
    public function changePassword(int $userId, string $newPassword): void
    {
        $this->userRepository->changePassword($userId, $newPassword);
    }
}