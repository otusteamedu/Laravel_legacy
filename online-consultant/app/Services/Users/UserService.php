<?php

namespace App\Services\Users;

use App\Models\User;
use App\Repositories\Users\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    private $repository;
    
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * Get all users
     *
     * @param  array  $columns
     *
     * @return Collection
     */
    public function allUsers($columns = []): Collection
    {
        return $this->repository->all($columns);
    }
    
    /**
     * Get paginated users
     *
     * @param  int  $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginateUsers(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }
    
    /**
     * Paginate users incl. trashed
     *
     * @param  int  $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginateUsersWithTrashed(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginateWithTrashed($perPage);
    }
    
    /**
     * Create user
     *
     * @param  array  $data
     *
     * @return User
     */
    public function createUser(array $data): User
    {
        return $this->repository->create($data);
    }
    
    /**
     * Find user by id
     *
     * @param  int  $id
     *
     * @return User|null
     */
    public function findUser(int $id): ?User
    {
        return $this->repository->find($id);
    }
    
    /**
     * Find user by id incl. trashed
     *
     * @param  int  $id
     *
     * @return User|null
     */
    public function findUserWithTrashed(int $id): ?User
    {
        return $this->repository->findWithTrashed($id);
    }
    
    /**
     * Update user
     *
     * @param  User  $user
     * @param  array  $data
     *
     * @return User
     */
    public function updateUser(User $user, array $data): User
    {
        return $this->repository->update($user, $data);
    }
    
    /**
     * Delete user
     *
     * @param  User  $user
     *
     * @return bool|null
     * @throws \Exception
     */
    public function deleteUser(User $user): ?bool
    {
        return $this->repository->delete($user);
    }
    
    /**
     * Restore user
     *
     * @param  int  $id
     *
     * @return bool|null
     */
    public function restoreUser(int $id): ?bool
    {
        $user = $this->findUserWithTrashed($id);
        
        if (!$user) {
            return false;
        }
        
        return $this->repository->restore($user);
    }
    
    /**
     * Permanently delete user
     *
     * @param  int  $id
     *
     * @return bool|null
     */
    public function forceDeleteUser(int $id): ?bool
    {
        $user = $this->findUserWithTrashed($id);
        
        if (!$user) {
            return false;
        }
        
        return $this->repository->forceDelete($user);
    }
    
    /**
     * Get array of users for form select
     *
     * @return array
     */
    public function getFormSelectUsers(): array
    {
        $formSelectUsers = [];
        $rawUsers = $this->repository->getFormSelectOptions(['id', 'name']);
        
        if (count($rawUsers) === 0) {
            return $formSelectUsers;
        }
        
        foreach ($rawUsers as $user) {
            $formSelectUsers[$user['id']] = $user['name'];
        }
        
        return $formSelectUsers;
    }
}
