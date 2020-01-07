<?php
/** Для работы со всеми обращениями к БД. */
namespace App\Services\Users\Repositories;
use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * Get's a User by it's ID
     * @param int
     */
    public function get($id);

    /**
     * Get's all users.
     * @return mixed
     */
    public function all();

    /**
     * Deletes a user.
     * @param int
     */
    public function delete($id);

    /**
     * Updates a user.
     * @param User
     * @param array
     */
    public function update(User $user, array $data);

    /**
     * Create a user from array.
     * @param array
     * @return User
     */
    public function create(array $data):User;

    // создадим ещё какую-нибудь функцию
    // функций можно насоздавать сколько нужно
    public function getUserByName(string $name):User;

    public function search(array $filters = []);
}
