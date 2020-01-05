<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    /**
     * Get's a User by it's ID
     *
     * @param int
     */
    public function get($id);

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
    public function delete($id);

    /**
     * Updates a user.
     *
     * @param int
     * @param array
     */
    public function update($id, array $data);

    /**
     * Create a user.
     *
     * @author Denis Abidov
     * @param array
     */
    public function store(array $data);

}
