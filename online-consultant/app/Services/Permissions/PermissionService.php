<?php

namespace App\Services\Permissions;

use App\Repositories\Permissions\PermissionRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Permission;

class PermissionService
{
    private $permissionRepository;
    
    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }
    
    /**
     * Get all permissions
     *
     * @param  array  $columns
     *
     * @return Collection
     */
    public function allPermissions($columns = ['*']): Collection
    {
        return $this->permissionRepository->all($columns);
    }
    
    /**
     * Create permission
     *
     * @param  array  $data
     *
     * @return Permission
     */
    public function createPermission(array $data): Permission
    {
        return $this->permissionRepository->create($data);
    }
    
    /**
     * Find permission by id
     *
     * @param  int  $id
     *
     * @return Permission|null
     */
    public function findPermission(int $id): ?Permission
    {
        return $this->permissionRepository->find($id);
    }
    
    /**
     * Update permission
     *
     * @param  Permission  $permission
     * @param  array  $data
     *
     * @return Permission
     */
    public function updatePermission(Permission $permission, array $data): Permission
    {
        return $this->permissionRepository->update($permission, $data);
    }
    
    /**
     * Delete permission
     *
     * @param  Permission  $permission
     *
     * @return bool|null
     * @throws \Exception
     */
    public function deletePermission(Permission $permission): ?bool
    {
        return $this->permissionRepository->delete($permission);
    }
    
    /**
     * Get array of permissions for form select
     *
     * @return array
     */
    public function getFormSelectPermissions(): array
    {
        $formSelectPermissions = [];
        $rawPermissions = $this->permissionRepository->getFormSelectOptions(['id', 'name']);
        
        if (count($rawPermissions) === 0) {
            return $formSelectPermissions;
        }
        
        foreach ($rawPermissions as $permission) {
            $formSelectPermissions[$permission['id']] = $permission['name'];
        }
        
        return $formSelectPermissions;
    }
}
