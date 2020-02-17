<?php

use App\Models\Catalog\Category;
use Illuminate\Database\Seeder;

class CatalogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class, 10)->create();
    }
}
