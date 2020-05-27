<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\CategoryTranslation;

class CategoryTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_translations')->truncate();

        $categories = Category::all();

        foreach ($categories as $category) {
            $categoryTranslation = new CategoryTranslation();
            $categoryTranslation->category_id = $category->id;
            $categoryTranslation->attribute = 'name';
            $categoryTranslation->value = $category->name . 'Ru';
            $categoryTranslation->save();
        }
    }
}