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
        $this->call(UsersTableSeeder::class);       // засей таблицу пользователей
        $this->call(AccountsTableSeeder::class);    // засей таблицу акаунтов
        $this->call(OrdersTableSeeder::class);      // засей таблицу заказов
    }
}
