<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    const ROLES = [
        'manager', 'admin'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::ROLES as $role)
            factory(\App\Models\Role::class)->create(['name' => $role]);
    }
}
