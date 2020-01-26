<?php


namespace App\Services\Admin\Users\Repositories;

use App\Models\User;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Class UsersRepository
 * @package App\Services\Admin\Users\Repositories
 */
class UsersRepository
{
    /**
     * @param User $user
     * @param array $data
     * @return bool
     */
    public function updateUser(User $user, array $data)
    {
        return $user->update($data);
    }
    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getList()
    {
        return User::with('role:description,id')
            ->paginate(20);
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function getUserById(int $id)
    {
        return User::findOrFail($id);
    }


    /**
     * @param array $data
     * @return User|\Illuminate\Database\Eloquent\Model
     */
    public function createUser(array $data)
    {
        $result = User::create($data);
        if (!$result) {
            throw new BadRequestHttpException();
        }
        return $result;
    }
}
