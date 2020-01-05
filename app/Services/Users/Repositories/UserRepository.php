<?php

namespace App\Services\Users\Repositories;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Get's a user by it's ID
     * @param int
     * @return User
     */
    public function get($id)
    {
        return User::find($id);
    }

    /**
     * Get's all users.
     * @return mixed
     */
    public function all()
    {
        return User::all();
    }

    /**
     * Deletes a user.
     * @param int $id
     */
    public function delete($id)
    {
        User::destroy($id);
    }

    /**
     * Updates a user.
     * @param User $user
     * @param array $data
     * @return User
     */
    public function update(User $user, array $data):User
    {
        $user->update($data);
        return $user;
    }

    /**
     * Create a user.
     *
     * @author Denis Abidov
     * @param array
     * @return User
     */
    public function create(array $data):User
    {
        $user = new User();
        $user->create($data);
        return $user;
        // Было просто
        // return User::create($data);
    }

    // создадим ещё какую-нибудь функцию
    // функций можно насоздавать сколько нужно
    public function getUserByName(string $name):User
    {
        return User::where('name',$name)->first();
    }

    /**
     * Search users by filters
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function search(array $filters = [])
    {
        $query = User::query();
        $this->applyFilters($query, $filters);
        return $query->paginate();
    }


    private function applyFilters(Builder $builder, array $filters)
    {
        if (isset($filters['name']))
        {
            $builder->where('name', $filters['name']);
        }
    }
}
