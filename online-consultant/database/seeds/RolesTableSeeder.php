<?php

use App\Models\Role;
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
        $defaultRoles = $this->getDefaultRoles();

        foreach ($defaultRoles as $role) {
            Role::create($role);
        }
    }

    /**
     * Default roles
     *
     * @return array
     */
    private function getDefaultRoles(): array
    {
        return [
            [
                'name' => 'app_user',
                'display_name' => __('App User')
            ],
            [
                'name' => 'app_admin',
                'display_name' => __('App Admin')
            ],
            [
                'name' => 'company_user',
                'display_name' => __('Company User')
            ],
            [
                'name' => 'company_manager',
                'display_name' => __('Company Manager')
            ],
            [
                'name' => 'company_admin',
                'display_name' => __('Company Admin')
            ]
        ];
    }
}
