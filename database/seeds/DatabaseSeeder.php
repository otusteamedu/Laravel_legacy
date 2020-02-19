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
        $this->call(NewsTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(CatalogCategorySeeder::class);
        $this->call(CatalogSpecificationSeeder::class);
        $this->call(CatalogPriceSeeder::class);
        $this->call(CatalogItemSeeder::class); 
        $this->call(CatalogSpecificationsAlliesSeeder::class);
        $this->call(CatalogPriceAlliesSeeder::class);
    }
}
