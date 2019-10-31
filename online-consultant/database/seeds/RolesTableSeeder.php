<?php

use App\Models\Role;
use App\Policies\Roles;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Roles::getRolesData() as $roleData) {
            $role = Role::create($roleData);
            $rolePermissions = Permissions::getPermissionsByRole($role);
        
            if ($rolePermissions) {
                $role->syncPermissions($rolePermissions);
            }
        }
    }
}
