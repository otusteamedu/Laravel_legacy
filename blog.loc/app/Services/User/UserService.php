<?php
namespace App\Services\User;

use App\Repositories\Interfaces\UserRepositoryInterface;
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
    public function getUsers()
    {
        $users = $this->userRepository->getAll();

        return $users;
    }

    /**
     * Получаем текущего авторизированного пользователя
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function getCurrentUser()
    {
        $currentUser = Auth::user();

        return $currentUser;
    }

    /**
     * Создаем нового пользователя
     * @param $data
     * @return mixed
     */
    public function createUser($data)
    {
        try {
            $user = $this->userRepository->add($data);
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    /**
     * Активируем пользователя
     * @param $userId
     * @return bool
     */
    public function activate($userId)
    {
        try {
            $this->userRepository->activate($userId);
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    /**
     * Деактивируем пользователя
     * @param $userId
     * @return bool
     */
    public function unactivate($userId)
    {
        try {
            $this->userRepository->deactivate($userId);
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function getUserById($userId)
    {
        try {
            $res = $this->userRepository->getById($userId);
            return $res;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function editFirstName($userId, $newFirstName)
    {
        try {
            $userData = [];
            $userData['first_name'] = $newFirstName;
            $this->userRepository->update($userId, $userData);
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function editLastName($userId, $newLastName)
    {
        try {
            $userData = [];
            $userData['last_name'] = $newLastName;
            $this->userRepository->update($userId, $userData);
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function editBirthday($userId, $newBirthday)
    {
        try {
            $userData = [];
            $userData['birthday'] = $newBirthday;
            $this->userRepository->update($userId, $userData);
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function editRole($userId, $newRoleId)
    {
        try {
            $userData = [];
            $userData['role_id'] = $newRoleId;
            $this->userRepository->update($userId, $userData);
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function destroy($userId)
    {
        try {
            $this->userRepository->delete($userId);
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function changePassword($userId, $newPassword)
    {
        try {
            $this->userRepository->changePassword($userId, $newPassword);
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }

    }
}