<?php

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
        $role = \App\Models\Role::where('name', 'authenticated user')->first();
        foreach (\App\Models\User::all() as $user) {
            App\Models\RoleUser::create([
                'role_id' => $role->id,
                'user_id' => $user->id,
            ]);
        }
    }
}
