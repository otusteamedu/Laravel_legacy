<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    /**
     * Get's a User by it's ID
     *
     * @param int
     */
    public function get($user_id);

    /**
     * Get's all users.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a user.
     *
     * @param int
     */
    public function delete($user_id);

    /**
     * Updates a user.
     *
     * @param int
     * @param array
     */
    public function update($user_id, array $user_data);

}
