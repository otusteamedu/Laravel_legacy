<?php

namespace App\Services\Users\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository
{
    /**
     * @param $id
     * @return User|null
     */
    public function find($id)
    {
        return User::find($id);
    }

    /**
     * @param array $columns
     * @return User[]|Collection
     */
    public function getAll(array $columns = ['*'])
    {
        return User::all($columns);
    }


    /**
     * @param array|null $options
     * @return LengthAwarePaginator
     */
    public function paginated(array $options = null)
    {
        return User::paginate();
    }


    /**
     * @param array $params
     * @param array|null $orderBy
     * @param int|null $limit
     * @param int|null $offset
     *
     * @return User[]|Collection|null
     */
    public function findBy(array $params, array $orderBy = null, $limit = null, $offset = null)
    {
        return User::where($params)->get();
    }

    /**
     * Finds a single entity by a set of params.
     *
     * @param array $params
     * @param array|null $orderBy
     *
     * @return User|null
     */
    public function findOneBy(array $params, array $orderBy = null)
    {
        //
    }

    /**
     * @param array $data
     * @return User|Model
     */
    public function createFromArray(array $data)
    {
        return User::create($data);
    }

    /**
     * @param User $user
     * @param array $data
     * @return User|Model
     */
    public function updateFromArray(User $user, array $data)
    {
        $user->update($data);

        return $user;
    }

    /**
     * @param User $user
     * @param array|null $options
     * @return bool|null
     * @throws \Exception
     */
    public function delete(User $user, array $options = null)
    {
        return $user->delete();
    }
}
