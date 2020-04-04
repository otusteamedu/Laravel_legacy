<?php

use Illuminate\Database\Seeder;

class AclSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Роли
        $this->call(AclRolesSeeder::class);

        // Доступы
        $this->call(AclPermissionsSeeder::class);
    }
}
