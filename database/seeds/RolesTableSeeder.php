<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Role::ROLES_AVAILABLE_NAME_LIST as $role) {
            factory(Role::class, 1)->create(['name' => $role]);
        }
    }
}
