<?php


namespace App\Repositories\Interfaces;


use App\Base\Repository\IBaseRepository;
use App\Models\Module;
use App\Models\Role;

interface IModuleRepository extends IBaseRepository
{
    /**
     * @return array
     */
    public function getModuleAccess(): array;
    /**
     * возвращает матрицу прав в формате ассоциативного массива
     * [module_id => [role => access_id,... ]...]
     * @return array
     */
    public function getPermissions(): array;
    /**
     * возвращает вектор прав на $module в формате ассоциативного массива
     * [role_id => access_id,... ]
     * @param Module $module
     * @return array
     */
    public function getModulePerms(Module $module): array;
    /**
     * возвращает вектор привилегий $role в формате ассоциативного массива
     * [module_id => access_id,... ]
     * @param Role $role
     * @return array
     */
    public function getRolePerms(Role $role): array;
    /**
     * @param Role $role
     * @param Module $module
     * @return array
     */
    public function getRoleModulePerms(Role $role, Module $module): array;
    /**
     * @param array $permissions
     * @return mixed
     */
    public function savePermissions(array $permissions): void;
    /**
     * @param Role $role
     * @param array $permissions
     */
    public function saveRolePermissions(Role $role, array $permissions): void;
}
