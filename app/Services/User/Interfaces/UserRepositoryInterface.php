<?php

declare(strict_types=1);

namespace App\Services\User\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface UserRepositoryInterface
 *
 * @package App\Repositories\Interfaces
 * @todo Добавить тайпхинты для возвращаемых значений
 * @todo Разбить интерфейс на несколько меньших интерфейсов для соответствия ISP
 */
interface UserRepositoryInterface
{
    /**
     * Get all of the records from the database.
     *
     * @param  array  $columns
     * @return Collection|static[]
     */
    public function all(array $columns = ['*']);

    /**
     * Paginate the given query.
     *
     * @param  int  $perPage
     * @param  array  $columns
     * @return Collection|static[]
     */
    public function paginate(int $perPage = 15, array $columns = ['*']);

    /**
     * Find a record by its primary key.
     *
     * @param  int  $id
     * @return User|Collection|static[]|static|null
     */
    public function findById(int $id);

    /**
     * Find a record by an attribute/value.
     *
     * @param  string  $attribute
     * @param  string  $value
     * @return User|Collection|static[]|static|null
     */
    public function findBy(string $attribute, string $value);

    /**
     * Create a record and fill it with values.
     *
     * @param  array  $data
     * @return User|static
     */
    public function create(array $data);

    /**
     * Update a record and fill it with values.
     *
     * @param  User  $user
     * @param  array  $data
     * @return User|static
     */
    public function update(User $user, array $data);

    /**
     * Delete a record from the database.
     *
     * @param  User  $user
     * @return mixed
     */
    public function delete(User $user);

    // @todo Добавить методы для связанных сущностей

}
