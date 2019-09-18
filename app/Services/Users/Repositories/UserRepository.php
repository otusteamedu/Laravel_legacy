<?php

declare(strict_types=1);

namespace App\Services\Users\Repositories;

use App\Services\Users\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface {

    /**
     * Get all of the records from the database.
     *
     * @param  array  $columns
     * @return Collection|static[]
     */
    public function all(array $columns = ['*'])
    {
        return User::all($columns);
    }

    /**
     * Paginate the given query.
     *
     * @param  int  $perPage
     * @param  array  $columns
     * @return Collection|static[]
     */
    public function paginate(int $perPage = 15, array $columns = ['*'])
    {
        return User::paginate($perPage, $columns);
    }

    /**
     * Find a record by its primary key.
     *
     * @param  int  $id
     * @return User|Collection|static[]|static|null
     */
    public function find(int $id)
    {
        // TODO: Implement find() method.
    }

    /**
     * Find a record by an attribute/value.
     *
     * @param  string  $attribute
     * @param  string  $value
     * @return User|Collection|static[]|static|null
     */
    public function findBy(string $attribute, string $value)
    {
        // TODO: Implement findBy() method.
    }

    /**
     * Create a record and fill it with values.
     *
     * @param  array  $data
     * @return User|static
     */
    public function create(array $data)
    {
        $User = new User();
        $User->create($data);
        return $User;
    }

    /**
     * Update a record and fill it with values.
     *
     * @param  User  $User
     * @param  array  $data
     * @return User|static
     */
    public function update(User $User, array $data)
    {
        $User->update($data);
        return $User;
    }

    /**
     * Delete a record from the database.
     *
     * @param  User  $User
     * @return mixed
     * @throws \Exception
     */
    public function delete(User $User)
    {
        return $User->delete();
    }

}
