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
       
        $parentCategory = Category::class->pluck('id')->toArray();

        factory(Category::class, 10)->create()->each(function($category) use($parentCategory){
            //$category->parent_id->update(Arr::random($parentCategory));
            $category->item()->saveMany(factory(Item::class, 12)->make());
        });
    }
}
