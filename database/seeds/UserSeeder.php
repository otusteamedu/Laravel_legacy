<?php

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
        factory(App\Models\User::class, 10)->create();

        DB::update('update users set role_id = ?, email = ? where id = ?', [1, '1633131@mail.ru', 1]);
        DB::update('update users set role_id = ? where id = ?', [3, 3]);
    }
}
