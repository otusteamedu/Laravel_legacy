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
        // @todo Вынести список ролей в отдельный класс и обращаться к нему отсюда
        $role = \App\Models\Role::where('name', 'authenticated user')->first();
        foreach (\App\Models\User::all() as $user) {
            App\Models\RoleUser::create([
                'role_id' => $role->id,
                'user_id' => $user->id,
            ]);
        }
    }
}
