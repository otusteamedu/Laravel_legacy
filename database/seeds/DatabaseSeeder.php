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
        $this->call(CategoryProductTableSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(DeliverySeeder::class);
        $this->call(OrderSeeder::class);
    }
}
