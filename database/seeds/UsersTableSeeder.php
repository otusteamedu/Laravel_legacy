<?php

use App\Models\Role;
use App\Models\RoleUser;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    const COUNT_USERS = 5;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Role::all() as $role)
            $roles[] = $role;

        /** @var \App\User $user */
        $createUserRole = function ($user) use ($roles) {
            $randomRole = $roles[array_rand($roles)];
            $user->roles()->attach($randomRole);
        };

        factory(\App\User::class, self::COUNT_USERS)->create()->each($createUserRole);
    }
}
