<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->truncate();
        DB::table('products_ru')->truncate();

        factory(Product::class, rand(50, 200))->create();

        $products = Product::all();
        foreach($products as $product) {
            $productRu = $product->getProductRu();
            $productRu->name = $product->name . 'Ru';
            $productRu->description = $product->description . 'Ru';
            $productRu->save();
        }
    }
}
