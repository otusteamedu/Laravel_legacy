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
        $this->call(
/*             NewsTableSeeder::class,
            UserTableSeeder::class,
            CatalogCategorySeeder::class,
            CatalogSpecificationSeeder::class, */
            CatalogItemSeeder::class,
            //CatalogAlliesSeeder::class
        );
    }
}
