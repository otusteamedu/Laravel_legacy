<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Article;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Для каждой категории создаем по 10 статей
     *
     * @return void
     */
    public function run()
    {
        foreach (Category::all() as $category) {
            factory(Article::class, 10)->create(['category_id' => $category->id]);
        }
    }
}
