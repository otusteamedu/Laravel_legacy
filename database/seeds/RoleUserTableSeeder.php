<?php

use App\Models\Role;
use App\User;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Role::all() as $role)
            $roles[] = $role;

        foreach (User::all() as $user) {
            $randomRole = $roles[array_rand($roles)];
            $user->roles()->attach($randomRole);
        }
    }
}
