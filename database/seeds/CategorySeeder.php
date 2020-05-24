<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();
        DB::table('categories_ru')->truncate();

        factory(Category::class, rand(50, 150))->create();

        $categories = Category::all();
        foreach($categories as $category) {
            $category->nameRu($category->name . 'Ru');
        }
    }
}
