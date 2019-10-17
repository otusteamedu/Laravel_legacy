<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')
            ->insert([
                'email' => 'rnikolaenkov@yandex.ru',
                'first_name' => 'Роман',
                'last_name' => 'Николаенков',
                'password' => bcrypt('ghbdtnbr'),
                'status' => \App\Models\User\User::STATUS_ACTIVE,
                'role_id' => 1,
            ]);

        factory(\App\Models\User\User::class, 10)->create();
    }
}
