<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        //$this->call(ItemsTableSeeder::class);
        /**
         * При генерациии каждого пользователя сразу же вызываются фабрики 
         * для создания Accounts и Orders.
         * Поэтому не стал создавать AccountsTableSeeder.php и OrdersTableSeeder.php
         */
    }
}
