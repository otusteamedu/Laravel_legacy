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
        foreach (\App\Models\Account::all() as $account) {
            factory(\App\Models\User::class, 4)->create(['account_id' => $account->id]);
        }

    }
}
