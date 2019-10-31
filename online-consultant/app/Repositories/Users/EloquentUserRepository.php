<?php

namespace App\Repositories\Users;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class EloquentUserRepository implements UserRepositoryInterface
{
    /**
     * Get all users
     *
     * @param  array  $columns
     *
     * @return Collection
     */
    public function all($columns = ['*']): Collection
    {
        return User::all($columns);
    }
    
    /**
     * Paginate users
     *
     * @param  int  $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->withCompany()->paginate($perPage);
    }
    
    /**
     * Paginate users incl. trashed
     *
     * @param  int  $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginateWithTrashed(int $perPage = 15): LengthAwarePaginator
    {
        return $this->withCompany()->withTrashed()->paginate($perPage);
    }
    
    /**
     * Eager loading for companies
     *
     * @return User|Builder
     */
    public function withCompany()
    {
        return User::with('company');
    }
    
    /**
     * Create user
     *
     * @param  array  $data
     *
     * @return User
     */
    public function create(array $data): User
    {
        $user = new User();
        $user->fill($data);
        $user->save();
        
        return $user;
    }
    
    /**
     * Find user by id
     *
     * @param  int  $id
     *
     * @return User|null
     */
    public function find(int $id): ?User
    {
        return User::find($id);
    }
    
    /**
     * Find user by id incl. trashed
     *
     * @param  int  $id
     *
     * @return User|null
     */
    public function findWithTrashed(int $id): ?User
    {
        return User::withTrashed()->find($id);
    }
    
    /**
     * Update user
     *
     * @param  User  $user
     * @param  array  $data
     *
     * @return User
     */
    public function update(User $user, array $data): User
    {
        $user->update($data);
        
        return $user;
    }
    
    /**
     * Delete user
     *
     * @param  User  $user
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete(User $user): ?bool
    {
        return $user->delete();
    }
    
    /**
     * Restore user
     *
     * @param  User  $user
     *
     * @return bool|null
     */
    public function restore(User $user): ?bool
    {
        return $user->restore();
    }
    
    /**
     * Permanently delete user
     *
     * @param  User  $user
     *
     * @return bool|null
     */
    public function forceDelete(User $user): ?bool
    {
        return $user->forceDelete();
    }
    
    /**
     * Get array of users for form select
     *
     * @param  array  $columns
     *
     * @return User[]|array|Collection
     */
    public function getFormSelectOptions($columns = [])
    {
        return $this->all($columns)->toArray();
    }
    
    /**
     * Detach roles
     *
     * @param  User  $user
     * @param  array  $roles
     */
    public function detachRoles(User $user, array $roles = []): void
    {
        $userRoles = $user->roles();
        
        if (count($roles) === 0) {
            $userRoles->detach();
        } else {
            $userRoles->detach($roles);
        }
    }
    
    /**
     * Assign roles
     *
     * @param  User  $user
     * @param  array  $roles
     */
    public function assignRoles(User $user, array $roles): void
    {
        if (count($roles) === 0) {
            return;
        }
        
        foreach ($roles as $role) {
            $user->assignRole($role);
        }
    }
}
