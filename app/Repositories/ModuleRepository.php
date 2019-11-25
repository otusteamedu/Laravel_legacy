<?php


namespace App\Repositories;


use App\Base\Repository\BaseRepository;
use App\Models\Module;
use App\Models\Role;
use App\Repositories\Interfaces\IModuleRepository;
use App\Repositories\Interfaces\IRoleRepository;
use Illuminate\Support\Facades\DB;

class ModuleRepository extends BaseRepository implements IModuleRepository
{
    /**
     * @var IRoleRepository
     */
    private $roleRepository;
    /**
     * ModuleRepository constructor.
     * @param IRoleRepository $roleRepository
     */
    public function __construct(IRoleRepository $roleRepository) {
        parent::__construct();
        $this->roleRepository = $roleRepository;
    }
    /**
     * @return array
     * @throws \App\Base\WrongNamespaceException
     */
    public function getModuleAccess(): array
    {
        $result = [];
        $modules = $this->getList();
        /** @var \App\Models\Module $module */
        foreach($modules as $i => $module) {
            $result[$i] = array_merge(
                $module->toArray(), ['accesses' => []]
            );
            /** @var \App\Models\ModAccess $access */
            foreach($module->accesses as $access)
                $result[$i]['accesses'][] = $access->toArray();
        }

        return $result;
    }
    /**
     * возвращает матрицу прав в формате ассоциативного массива
     * [module_id => [role_id => access_id,... ]...]
     * @return array
     * @throws \App\Base\WrongNamespaceException
     */
    public function getPermissions(): array
    {
        $roles = $this->roleRepository->getList4Perms();
        $modules = $this->getModuleAccess();

        $result = [];
        foreach ($modules as $module) {
            $mid = $module['id'];
            $result[$mid] = [];
            foreach ($roles as $role)
                $result[$mid][$role['id']] = 0;
        }

        $builder = \App\Models\ModPerm::query()
            ->select(['mod_perms.role_id', 'mod_perms.access_id', 'mod_accesses.module_id'])
            ->join('roles', 'mod_perms.role_id', '=', 'roles.id')
            ->join('mod_accesses', 'mod_perms.access_id', '=', 'mod_accesses.id')
            ->join('modules', 'mod_accesses.module_id', '=', 'modules.id');

        $perms = $builder->get()->all();

        foreach ($perms as $perm) {
            if(array_key_exists($perm->module_id, $result)
                && array_key_exists($perm->role_id, $result[$perm->module_id]))
            {
                $result[$perm->module_id][$perm->role_id] = $perm->access_id;
            }
        }

        return $result;
    }
    /**
     * возвращает вектор привилегий $role в формате ассоциативного массива
     * [module_id => access_id,... ]
     * @param Role $role
     * @return array
     * @throws \App\Base\WrongNamespaceException
     */
    public function getRolePerms(Role $role): array
    {
        $modules = $this->getModuleAccess();
        $result = [];
        foreach ($modules as $module)
            $result[$module['id']] = 0;

        $builder = \App\Models\ModPerm::query()
            ->select(['mod_perms.access_id', 'mod_accesses.module_id'])
            ->join('roles', 'mod_perms.role_id', '=', 'roles.id')
            ->join('mod_accesses', 'mod_perms.access_id', '=', 'mod_accesses.id')
            ->join('modules', 'mod_accesses.module_id', '=', 'modules.id')
            ->where('mod_perms.role_id', '=', $role->id);

        $perms = $builder->get()->all();
        foreach ($perms as $perm)
            $result[$perm->module_id] = $perm->access_id;

        return $result;
    }

    /**
     * возвращает вектор прав на $module в формате ассоциативного массива
     * [role_id => access_id,... ]
     * @param Module $module
     * @return array
     * @throws \App\Base\WrongNamespaceException
     */
    public function getModulePerms(Module $module): array
    {
        $roles = $this->roleRepository->getList4Perms();
        $result = [];
        foreach ($roles as $role)
            $result[$role['id']] = 0;

        $builder = \App\Models\ModPerm::query()
            ->select(['mod_perms.role_id', 'mod_perms.access_id'])
            ->join('roles', 'mod_perms.role_id', '=', 'roles.id')
            ->join('mod_accesses', 'mod_perms.access_id', '=', 'mod_accesses.id')
            ->join('modules', 'mod_accesses.module_id', '=', 'modules.id')
            ->where('modules.id', '=', $module->id);

        $perms = $builder->get()->all();
        foreach ($perms as $perm)
            $result[$perm->role_id] = $perm->access_id;

        return $result;
    }

    /**
     * @param Role $role
     * @param Module $module
     * @return mixed
     */
    public function getRoleModulePerms(Role $role , Module $module): array
    {
        return \App\Models\ModAccess::query()
            ->select(['mod_accesses.*'])
            ->join('mod_perms', 'mod_perms.access_id', '=', 'mod_accesses.id')
            ->join('roles', 'mod_perms.role_id', '=', 'roles.id')
            ->join('modules', 'mod_accesses.module_id', '=', 'modules.id')
            ->where('modules.id', '=', $module->id)
            ->where('roles.id', '=', $role->id)
            ->get()->first()->toArray();
    }
    /**
     * делаем все по-простому
     *
     * @param array $permissions
     * @return mixed
     */
    public function savePermissions(array $permissions): void
    {
        $that = $this;
        DB::transaction(function () use ($permissions, $that) {
            DB::table('mod_perms')->truncate();
            $oldPerms = $this->getPermissions();
            foreach ($permissions as $moduleId => $accesses) {
                if(!is_array($accesses) || !array_key_exists($moduleId, $oldPerms))
                    continue;
                foreach ($accesses as $role_id => $access_id) {
                    if(array_key_exists($role_id, $oldPerms[$moduleId])
                        && !empty($permissions[$moduleId][$role_id]))
                    {
                        $model = new \App\Models\ModPerm;
                        $model->fill([
                            'role_id' => $role_id,
                            'access_id' => (int) $permissions[$moduleId][$role_id]
                        ]);
                        $model->save();
                    }
                }
            }
        });
    }

    public function saveRolePermissions(Role $role, array $permissions): void
    {
        DB::transaction(function () use ($permissions) {

        });
    }
}
