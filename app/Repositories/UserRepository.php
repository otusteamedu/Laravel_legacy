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
    public function get($id)
    {
        return User::find($id);
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
    public function delete($id)
    {
        User::destroy($id);
    }

    /**
     * Updates a user.
     *
     * @param int
     * @param array
     */
    public function update($id, array $data)
    {
        User::find($id)->update($data);
    }

    /**
     * Create a user.
     *
     * @author Denis Abidov
     * @param array
     */
    public function store(array $data)
    {
        User::create($data);
    }
}