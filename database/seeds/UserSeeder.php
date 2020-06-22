<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::all()->each(function (Role $role) {
            factory(User::class, 10)->create([
                'role_id' => $role->id,
            ]);
        });

        factory(User::class, 200)->create([
            'role_id' => Role::STUDENT,
        ]);
    }
}
