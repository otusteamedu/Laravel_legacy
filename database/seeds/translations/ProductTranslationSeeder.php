<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Translations\ProductTranslation;
use Illuminate\Support\Facades\DB;

class ProductTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_translations')->truncate();

        $products = Product::all();

        foreach ($products as $product) {
            $this->addTranslation($product, 'name');
            $this->addTranslation($product, 'description');
        }
    }

    private function addTranslation($product, $attribute)
    {
        $translation = new ProductTranslation();
        $translation->product_id = $product->id;
        $translation->locale = 'ru';
        $translation->attribute = $attribute;
        $translation->value = $product->$attribute . 'Ru';
        $translation->save();
    }
}
