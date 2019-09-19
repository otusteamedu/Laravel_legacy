<?php

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var User $user */
        $user = User::query()->create([
            'name' => 'Administrator',
            'email' => 'administrator@domain.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        /** @var Role[]|Collection $roles */
        $roles = Role::all();

        $user->roles()->attach($roles);

        /** @var Role $role */
        if($role = $roles->where('name', 'Administrator')->first()) {
            $role->permissions()->attach(Permission::all());
        }

    }
}
