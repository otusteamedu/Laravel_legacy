<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Models\Account::all() as $account) {
            factory(\App\Models\Setting::class, 1)->create(['created_account_id' => $account->id]);
        }

    }
}
