<?php

use Illuminate\Database\Seeder;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\UserRole::class, 1)->create([
            'name' => 'admin',
        ]);
        factory(App\Models\UserRole::class, 1)->create();
    }
}
