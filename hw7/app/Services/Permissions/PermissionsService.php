<?php
/**
 * Description of PermissionsService.php
 *
 *
 */

namespace App\Services\Permissions;
use App\Models\Permission;

use App\Services\Permissions\Repositories\PermissionRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PermissionsService
{

    /** @var PermissionRepositoryInterface */
    private $permissionRepository;

    private $createPermissionHandler;

    public function __construct(

        PermissionRepositoryInterface $permissionRepository
    )
    {
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * @param int $id
     * @return Permission|null
     */
    public function findPermission(int $id)
    {
        // return $this->permissionRepository->find($id);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchPermissions(): LengthAwarePaginator
    {
        return $this->permissionRepository->search();

    }

    /**
     * @param array $data
     * @return Permission
     */
    public function storePermission(array $data): Permission
    {
        $permission = $this->permissionRepository->create($data);
        return $permission;
    }

    /**
     * @param Permission $permission
     * @param array $data
     * @return Permission
     */
    public function updatePermission(Permission $permission, array $data)
    {
        return $this->permissionRepository->updateFromArray($permission, $data);
    }

    public function deletePermission(int $id)
    {
        return $this->permissionRepository->delete($id);
    }


}