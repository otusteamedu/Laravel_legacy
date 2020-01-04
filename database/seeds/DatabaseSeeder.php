<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $this->call([
            UsersTableSeeder::class,
            FormatsTableSeeder::class,
            ImagesTableSeeder::class,
            TexturesTableSeeder::class, // ! after ImagesTableSeeder::class
            CategoriesTableSeeder::class, // ! after ImagesTableSeeder::class
            TagsTableSeeder::class,
            OwnersTableSeeder::class,
            DeliveriesTableSeeder::class,
            OrderStatusesTableSeeder::class,
        ]);
    }
}
