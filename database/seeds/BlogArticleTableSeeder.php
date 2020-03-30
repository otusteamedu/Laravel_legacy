<?php

use Illuminate\Database\Seeder;
use App\Models\Blog\Author;
use App\Models\Blog\Category;

class BlogArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  Получаем случайного автора
        $authors = Author::all();

        // Бежим по авторам
        foreach ($authors as $author) {
            $arCategory = [
                 'blog_author_id' => $author->id
            ];

            // Фабрика
            factory(App\Models\Blog\Article::class, rand(1, 10))->create($arCategory)->each(function($article) {

                // Получаем случайные категории
                $categories = \App\Models\Blog\Category::all();
                $randCategories = $categories->random(rand(1, $categories->count() > 3 ? 3 : $categories->count()));

                foreach ($randCategories as $randCategory) {
                    $randCategory->articles()->attach($article->id);
                };
            });
        }
    }
}
