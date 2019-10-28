<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    // TODO rebuild factories - we don't need companies to set users etc.
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(CompaniesTableSeeder::class);
         $this->call(WidgetsTableSeeder::class);
         $this->call(LeadsTableSeeder::class);
         $this->call(ConversationsTableSeeder::class);
    }
}
