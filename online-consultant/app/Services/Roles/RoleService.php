<?php

namespace App\Services\Roles;

use App\Repositories\Roles\RoleRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Role;

class RoleService
{
    private $roleRepository;
    
    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }
    
    /**
     * Get all roles
     *
     * @param  array  $columns
     *
     * @return Collection
     */
    public function allRoles($columns = ['*']): Collection
    {
        return $this->roleRepository->all($columns);
    }
    
    /**
     * Create role
     *
     * @param  array  $data
     *
     * @return Role
     */
    public function createRole(array $data): Role
    {
        return $this->roleRepository->create($data);
    }
    
    /**
     * Find role by id
     *
     * @param  int  $id
     *
     * @return Role|null
     */
    public function findRole(int $id): ?Role
    {
        return $this->roleRepository->find($id);
    }
    
    /**
     * Update role
     *
     * @param  Role  $role
     * @param  array  $data
     *
     * @return Role
     */
    public function updateRole(Role $role, array $data): Role
    {
        return $this->roleRepository->update($role, $data);
    }
    
    /**
     * Delete role
     *
     * @param  Role  $role
     *
     * @return bool|null
     * @throws \Exception
     */
    public function deleteRole(Role $role): ?bool
    {
        return $this->roleRepository->delete($role);
    }
    
    /**
     * Get array of roles for form select
     *
     * @return array
     */
    public function getFormSelectRoles(): array
    {
        $formSelectRoles = [];
        $rawRoles = $this->roleRepository->getFormSelectOptions(['id', 'name']);
        
        if (count($rawRoles) === 0) {
            return $formSelectRoles;
        }
        
        foreach ($rawRoles as $role) {
            $formSelectRoles[$role['id']] = $role['name'];
        }
        
        return $formSelectRoles;
    }
}
