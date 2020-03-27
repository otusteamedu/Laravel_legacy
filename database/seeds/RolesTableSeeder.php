<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    private function getAvailableRoleList() {
        return Role::AVAILABLE_SPEC_ROLE_LIST;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->getAvailableRoleList() as $role) {
            factory(Role::class, 1)->create(['name' => $role]);
        }
    }
}
