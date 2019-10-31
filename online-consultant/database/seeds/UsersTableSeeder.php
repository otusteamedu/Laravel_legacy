<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 5)->create();
        
        foreach (User::all() as $user) {
            /** @var User $user */
            if (!$user->hasAnyRole(Role::all())) {
                $user->assignRole(Role::defaultRole);
            }
        }
    }
}
