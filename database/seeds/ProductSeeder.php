<?php

use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (CategoryProduct::all() as $category) {
            factory(Product::class, rand(1,2))->create([
                'category_id' => $category->id,
            ]);
        }
    }
}
