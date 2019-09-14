<?php

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
        // @todo Вынести список ролей в отдельный класс
        $roles = [
            'authenticated user',
            'administrator',
        ];
        foreach ($roles as $role) {
            App\Models\Role::create(['name' => $role]);
        }
    }
}
