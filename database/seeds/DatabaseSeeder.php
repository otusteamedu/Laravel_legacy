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
        $this->call(RoleSeeder::class);

        $this->call(UserSeeder::class);
        $this->call(UserStatisticSeeder::class);

        $this->call(TagSeeder::class);
        $this->call(ArticleSeeder::class);

        $this->call(LinkSeeder::class);
    }
}
