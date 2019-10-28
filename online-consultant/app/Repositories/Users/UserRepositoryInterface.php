<?php

namespace App\Repositories\Users;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    /**
     * Get all users
     *
     * @param  array  $columns
     *
     * @return Collection
     */
    public function all($columns = ['*']): Collection;
    
    /**
     * Paginate users
     *
     * @param  int  $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator;
    
    /**
     * Paginate users incl. trashed
     *
     * @param  int  $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginateWithTrashed(int $perPage = 15): LengthAwarePaginator;
    
    /**
     * Create user
     *
     * @param  array  $data
     *
     * @return User
     */
    public function create(array $data): User;
    
    /**
     * Find user by id
     *
     * @param  int  $id
     *
     * @return User|null
     */
    public function find(int $id): ?User;
    
    /**
     * Find user by id incl. trashed
     *
     * @param  int  $id
     *
     * @return User|null
     */
    public function findWithTrashed(int $id): ?User;
    
    /**
     * Update user
     *
     * @param  User  $user
     * @param  array  $data
     *
     * @return User
     */
    public function update(User $user, array $data): User;
    
    /**
     * Delete user
     *
     * @param  User  $user
     *
     * @return bool|null
     */
    public function delete(User $user): ?bool;
    
    /**
     * Restore user
     *
     * @param  User  $user
     *
     * @return bool|null
     */
    public function restore(User $user): ?bool;
    
    /**
     * Permanently delete user
     *
     * @param  User  $user
     *
     * @return bool|null
     */
    public function forceDelete(User $user): ?bool;
    
    /**
     * Get array of users for form select
     *
     * @param  array  $columns
     *
     * @return User[]|array|Collection
     */
    public function getFormSelectOptions($columns = []);
    
    /**
     * Detach roles
     *
     * @param  User  $user
     * @param  array  $roles
     */
    public function detachRoles(User $user, array $roles = []): void;
    
    /**
     * Assign roles
     *
     * @param  User  $user
     * @param  array  $roles
     */
    public function assignRoles(User $user, array $roles): void;
}
