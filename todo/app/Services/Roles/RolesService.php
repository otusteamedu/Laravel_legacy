<?php
/**
 * Description of RolesService.php
 *
 *
 */

namespace App\Services\Roles;


use App\Models\Role;

use App\Services\Roles\Repositories\RoleRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class RolesService
{

    /** @var RoleRepositoryInterface */
    private $roleRepository;

    private $createRoleHandler;

    public function __construct(

        RoleRepositoryInterface $roleRepository
    )
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * @param int $id
     * @return Role|null
     */
    public function findRole(int $id)
    {
        // return $this->roleRepository->find($id);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchRoles()
    {
        return $this->roleRepository->search();

    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchRolesToArray()
    {
        return $this->roleRepository->searchToArray();

    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchRolePermissions(Role $role)
    {
        return $this->roleRepository->permissions($role);

    }

    /**
     * @param array $data
     * @return Role
     */
    public function storeRole(array $data): Role
    {
        $role = $this->roleRepository->create($data);
        return $role;
    }

    /**
     * @param Role $role
     * @param array $data
     * @return Role
     */
    public function updateRole(Role $role, array $data)
    {
        return $this->roleRepository->updateFromArray($role, $data);
    }

    public function deleteRole(int $id)
    {
        return $this->roleRepository->delete($id);
    }


}