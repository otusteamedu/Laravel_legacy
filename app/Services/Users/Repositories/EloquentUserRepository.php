<?php

namespace App\Services\Users\Repositories;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder ;

/**
 * Class EloquentUserRepository
 * @package App\Services\Users\Repositories
 */
class EloquentUserRepository implements UserRepositoryInterface
{
    public function find(int $id)
    {
        return User::find($id);
    }

    public function search(array $filters = []): LengthAwarePaginator
    {
        $user = User::query();
        $this->applyFilters($user, $filters);

        return $user->paginate();
    }

    public function createFromArray(array $data): User
    {
        $user = new User();

        try {
            $user->fill($data)->save(); // @ToDo: выяснить, почему вариант кода $user->create($data); не возвращет пользователя
        } catch (\Throwable $exception) {
            return 'Произошла ошибка при сохранении:'
                . $exception->getMessage(); // @ToDo: прикрутить обработку ошибок и их вывод на экран
        }

        return $user;
    }

    public function updateFromArray(User $user, array $data)
    {
        $user->update($data);

        return $user;
    }

    public function delete(int $id) {

    }

    /**
     * @param Builder $queryBuilder
     * @param array $filters
     */
    private function applyFilters(Builder $queryBuilder, array $filters) {

        if (isset($filters['name'])) {
            $queryBuilder->where('name', $filters['name']);
        }

        if (isset($filters['last_name'])) {
            $queryBuilder->where('last_name', $filters['last_name']);
        }

        if (isset($filters['country_id'])) {
            $queryBuilder->where('country_id', $filters['country_id']);
        }

        if (isset($filters['email'])) {
            $queryBuilder->where('email', $filters['email']);
        }

        if (isset($filters['phone'])) {
            $queryBuilder->where('phone', $filters['phone']);
        }
    }
}
