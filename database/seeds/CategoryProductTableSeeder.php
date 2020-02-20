<?php

use Illuminate\Database\Seeder;
use App\Models\CategoryProduct;

class CategoryProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CategoryProduct::class,2)->create();
    }
}
