<?php

use App\Models\Catalog\Category;
use App\Models\Catalog\Item;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class CatalogItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $parentCategory = Category::pluck('id')->toArray();

        factory(Category::class, 10)->create()->each(function($category) use($parentCategory){
            $category->update(['parent_id'=>Arr::random($parentCategory)]) ;
            $category->item()->saveMany(factory(Item::class, 12)->make());
        });
    }
}
