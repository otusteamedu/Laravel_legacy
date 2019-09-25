<?php

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
        foreach (\App\Models\User::all() as $user) {
            $user->update([
               'level' => \App\Models\User::LEVEL_ADMIN,
            ]);
        }
        factory(\App\Models\User::class, 10)->create();
    }
}
