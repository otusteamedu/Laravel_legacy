<?php

namespace App\Repositories;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Get's a user by it's ID
     *
     * @param int
     * @return collection
     */
    public function get($user_id)
    {
        return User::find($user_id);
    }

    /**
     * Get's all users.
     *
     * @return mixed
     */
    public function all()
    {
        return User::all();
    }

    /**
     * Deletes a user.
     *
     * @param int
     */
    public function delete($user_id)
    {
        User::destroy($user_id);
    }

    /**
     * Updates a user.
     *
     * @param int
     * @param array
     */
    public function update($user_id, array $user_data)
    {
        User::find($user_id)->update($user_data);
    }
}
