<?php

use App\Models\Catalog\CategorySpecification;
use App\Models\Catalog\Item;
use Illuminate\Database\Seeder;

class CatalogSpecificationItemValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = Item::all();
        $categorySpecificationAllies = CategorySpecification::all();
        
        foreach($items AS $item){
            $item->specification()->attach(
                $categorySpecificationAllies
                    ->where('category_id', $item->category_id)
                    ->random(2)
                    ->pluck('id')
                    ->toArray(),
                ['value'=>rand(10, 100)]
                    
            );
        } 
    }
}
