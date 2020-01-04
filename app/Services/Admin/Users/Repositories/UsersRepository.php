<?php


namespace App\Services\Admin\Users\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;

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
        return DB::table('users', 'u')
            ->select(['u.id', 'u.username', 'u.email', 'roles.description as role'])
            ->join('roles', 'u.role_id', '=', 'roles.id')
            ->orderBy('u.id')
            ->paginate(20);
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function getUserById(int $id)
    {
        return DB::table('users', 'u')
            ->select([
                'u.id as id',
                'u.username',
                'u.email',
                'u.role_id',
                'u.created_at',
                'u.updated_at',
                'roles.description as role'])
            ->join('roles', 'u.role_id', '=', 'roles.id')
            ->where('u.id', '=', $id)
            ->first();
    }

    /**
     * @param array $data
     * @return User
     */
    public function createUser(array $data)
    {
        return User::create($data);
    }
}
