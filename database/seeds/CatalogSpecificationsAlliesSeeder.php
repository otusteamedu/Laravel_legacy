<?php

use App\Models\Catalog\Category;
use App\Models\Catalog\Specification;
use Illuminate\Database\Seeder;

class CatalogSpecificationsAlliesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::where('parent_id', '<>', 0)->get();
        $specification = Specification::all();
        
        foreach($categories AS $category){
            $category->specification()->attach(
                $specification->random(3)->pluck('id')->toArray()
            );
        }
    }
}
