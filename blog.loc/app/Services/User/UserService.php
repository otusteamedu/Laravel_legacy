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
    public function getCurrentUser(): ?User
    {
        $currentUser = Auth::user();

        return $currentUser;
    }

    /**
     * Создаем нового пользователя
     * @param $data
     * @return mixed
     */
    public function createUser(array $data): ?User
    {
        try {
            $user = $this->userRepository->add($data);
            return $user;
        } catch (\Exception $e) {
            report($e);
            return null;
        }
    }

    /**
     * Активируем пользователя
     * @param $userId
     * @return bool
     */
    public function activate(int $userId): bool
    {
        try {
            $this->userRepository->activate($userId);
            return true;
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }

    /**
     * Деактивируем пользователя
     * @param $userId
     * @return bool
     */
    public function unactivate(int $userId): bool
    {
        try {
            $this->userRepository->deactivate($userId);
            return true;
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }

    /**
     * Получаем пользователя по ID
     * @param int $userId
     * @return User|null
     */
    public function getUserById(int $userId): ?User
    {
        try {
            $res = $this->userRepository->getById($userId);
            return $res;
        } catch (\Exception $e) {
            report($e);
            return null;
        }
    }

    /**
     * Оедактирование имени пользователя
     * @param int $userId
     * @param string $newFirstName
     * @return bool
     */
    public function editFirstName(int $userId, string $newFirstName): bool
    {
        try {
            $this->userRepository->update($userId, ['first_name' => $newFirstName]);
            return true;
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }

    /**
     * Реактироание фамилии пользователя
     * @param int $userId
     * @param string $newLastName
     * @return bool
     */
    public function editLastName(int $userId, string $newLastName): bool
    {
        try {
            $this->userRepository->update($userId, ['last_name' => $newLastName]);
            return true;
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }

    /**
     * Редактирование дня рождения
     * @param $userId
     * @param $newBirthday
     * @return bool
     */
    public function editBirthday(int $userId, string $newBirthday): bool
    {
        try {
            $this->userRepository->update($userId, ['birthday' => $newBirthday]);
            return true;
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }

    /**
     * Редактирование роли
     * @param $userId
     * @param $newRoleId
     * @return bool
     */
    public function editRole(int $userId, int $newRoleId): bool
    {
        try {
            $this->userRepository->update($userId, ['role_id' => $newRoleId]);
            return true;
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }

    /**
     * Удаление пользователя
     * @param $userId
     * @return bool
     */
    public function destroy(int $userId): bool
    {
        try {
            $this->userRepository->delete($userId);
            return true;
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }

    /**
     * Изменение пароля пользователя
     * @param int $userId
     * @param string $newPassword
     * @return bool
     */
    public function changePassword(int $userId, string $newPassword): bool
    {
        try {
            $this->userRepository->changePassword($userId, $newPassword);
            return true;
        } catch (\Exception $e) {
            error($e);
            return false;
        }
    }
}