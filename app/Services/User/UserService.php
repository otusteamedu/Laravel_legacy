<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Services\User\Interfaces\UserServiceInterface;
use App\Models\User;
use App\Services\User\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;

class UserService implements UserServiceInterface {

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserService constructor.
     *
     * @param  UserRepository  $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get all of the records from the database.
     *
     * @param  array  $columns
     * @return Collection|static[]
     */
    public function all(array $columns = ['*'])
    {
        return $this->userRepository->all($columns);
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
        return $this->userRepository->paginate($perPage, $columns);
    }

    /**
     * Find a record by its primary key.
     *
     * @param  int  $id
     * @return User|Collection|static[]|static|null
     */
    public function find(int $id)
    {
        return $this->userRepository->find($id);
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
        return $this->userRepository->findBy($attribute, $value);
    }

    /**
     * Create a record and fill it with values.
     *
     * @param  array  $data
     * @return User|static
     */
    public function create(array $data)
    {
        return $this->userRepository->create($data);
    }

    /**
     * Update a record and fill it with values.
     *
     * @param  User  $user
     * @param  array  $data
     * @return User|static
     */
    public function update(User $user, array $data)
    {
        return $this->userRepository->update($user, $data);
    }

    /**
     * Delete a record from the database.
     *
     * @param  User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $this->userRepository->delete($user);
    }

}
