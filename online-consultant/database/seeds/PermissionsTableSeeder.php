<?php

use App\Models\Permission;
use App\Policies\Permissions;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Permissions::getAllPermissions() as $permissionName) {
            Permission::create([
                'name' => $permissionName
            ]);
        }
    }
}
