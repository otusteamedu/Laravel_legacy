<?php

namespace App\Services\Users;

use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use App\Repositories\Users\UserRepositoryInterface;
use App\Services\Roles\RoleService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    private $userRepository;
    private $roleService;
    
    public function __construct(
        UserRepositoryInterface $userRepository,
        RoleService $roleService
    )
    {
        $this->userRepository = $userRepository;
        $this->roleService = $roleService;
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
        return $this->userRepository->all($columns);
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
        return $this->userRepository->paginate($perPage);
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
        return $this->userRepository->paginateWithTrashed($perPage);
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
        if (isset($data['roles'])) {
            $roles = $data['roles'];
            unset($data['roles']);
        } else {
            $roles = [Role::defaultRole];
        }
        
        $user = $this->userRepository->create($data);
        $this->userRepository->assignRoles($user, $roles);
        
        return $user;
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
        return $this->userRepository->find($id);
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
        return $this->userRepository->findWithTrashed($id);
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
        if (isset($data['roles'])) {
            $this->updateRoles($user, $data['roles']);
            unset($data['roles']);
        }
        
        return $this->userRepository->update($user, $data);
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
        return $this->userRepository->delete($user);
    }
    
    /**
     * Restore user
     *
     * @param  User  $user
     *
     * @return bool|null
     */
    public function restoreUser(User $user): ?bool
    {
        return $this->userRepository->restore($user);
    }
    
    /**
     * Permanently delete user
     *
     * @param  User  $user
     *
     * @return bool|null
     */
    public function forceDeleteUser(User $user): ?bool
    {
        return $this->userRepository->forceDelete($user);
    }
    
    /**
     * Get array of users for form select
     *
     * @return array
     */
    public function getFormSelectUsers(): array
    {
        $formSelectUsers = [];
        $rawUsers = $this->userRepository->getFormSelectOptions(['id', 'name']);
        
        if (count($rawUsers) === 0) {
            return $formSelectUsers;
        }
        
        foreach ($rawUsers as $user) {
            $formSelectUsers[$user['id']] = $user['name'];
        }
        
        return $formSelectUsers;
    }
    
    /**
     * Update user roles
     *
     * @param  User  $user
     * @param  array  $roles
     */
    public function updateRoles(User $user, array $roles): void
    {
        $this->userRepository->detachRoles($user);
        $this->userRepository->assignRoles($user, $roles);
    }
    
    /**
     * Get array of roles available for user for form select
     *
     * @param  User  $user
     *
     * @return array
     */
    public function getFormSelectUserRoles(User $user): array
    {
        $allRolesSelectList = $this->roleService->getFormSelectRoles();
        $userAvailableRoles = $user->getAvailableRoles();
        $userAvailableRolesSelectList = array_filter($allRolesSelectList, function ($roleId) use ($userAvailableRoles) {
            return in_array($roleId, $userAvailableRoles, true);
        }, ARRAY_FILTER_USE_KEY);
        
        return $userAvailableRolesSelectList;
    }
}
