<?php

namespace App\Repositories\Interfaces;


interface UserRepositoryInterface
{
    /**
     * Выводим всех пользователей
     * @return mixed
     */
    public function getAll();

    /**
     * Выводим пользователя по ID
     * @param int $userId
     * @return mixed
     */
    public function getById(int $userId);

    /**
     * Добавляем пользователя
     * @param array $userData
     * @return mixed
     */
    public function add(array $userData);

    /**
     * Изменяем пароль у пользовтаеля по ID
     * @param int $userId
     * @param string $newPassword
     * @return mixed
     */
    public function changePassword(int $userId, string $newPassword);

    /**
     * Активация пользователя по ID
     * @param int $userId
     * @return mixed
     */
    public function activate(int $userId);

    /**
     * Деактиваци пользователя по ID
     * @param int $userId
     * @return mixed
     */
    public function deactivate(int $userId);

    /**
     * Обновление пользователя
     * @param array $userData
     * @return mixed
     */
    public function update(array $userData);

    /**
     * Удаление пользователя
     * @param int $userId
     * @return mixed
     */
    public function delete(int $userId);
}