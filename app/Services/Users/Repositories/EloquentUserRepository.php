<?php
/**
 * Eloquent репозиторий для пользователей
 */

namespace App\Services\Users\Repositories;

use App\Models\User;
use App\Services\Currencies\Repositories\CurrencyRepositoryInterface;

class EloquentUserRepository implements UserRepositoryInterface
{

    /**
     * @param int $id
     * @return User|User[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function find(int $id)
    {
        return User::find($id);
    }

    /**
     * @param string $search
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchByNameOrEmail($search = '')
    {
        if ($search) {
            return User::where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orderBy('id', 'desc')->paginate();
        }
        return User::orderBy('id', 'desc')->paginate();
    }


    /**
     * @param array $data
     * @return User
     */
    public function createFromArray(array $data)
    {
        $user = new User();
        $user->create($data);
        return $user;
    }

    /**
     * @param int $id
     * @param array $data
     * @return User|User[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function updateFromArray($id, array $data)
    {
        $user = $this->find($id);
        $user->update($data);
        return $user;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete($id)
    {
        return User::where('id', $id)->delete();
    }
}
