<?php

declare(strict_types=1);

namespace App\Services\Users;

use App\Services\Users\Interfaces\UserServiceInterface;
use App\Models\User;
use App\Services\Users\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;

class UserService implements UserServiceInterface {

    /**
     * @var UserRepository
     */
    private $UserRepository;

    /**
     * UserService constructor.
     *
     * @param  UserRepository  $UserRepository
     */
    public function __construct(UserRepository $UserRepository)
    {
        $this->UserRepository = $UserRepository;
    }

    /**
     * Get all of the records from the database.
     *
     * @param  array  $columns
     * @return Collection|static[]
     */
    public function all(array $columns = ['*'])
    {
        return $this->UserRepository->all($columns);
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
        return $this->UserRepository->paginate($perPage, $columns);
    }

    /**
     * Find a record by its primary key.
     *
     * @param  int  $id
     * @return User|Collection|static[]|static|null
     */
    public function find(int $id)
    {
        return $this->UserRepository->find($id);
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
        return $this->UserRepository->findBy($attribute, $value);
    }

    /**
     * Create a record and fill it with values.
     *
     * @param  array  $data
     * @return User|static
     */
    public function create(array $data)
    {
        return $this->UserRepository->create($data);
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
        return $this->UserRepository->update($User, $data);
    }

    /**
     * Delete a record from the database.
     *
     * @param  User  $User
     * @return mixed
     */
    public function delete(User $User)
    {
        return $this->UserRepository->delete($User);
    }

}
