<?php

use Illuminate\Database\Seeder;
use App\Models\Blog\Author;

class BlogArticleSeeder extends Seeder
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
            $user = App\Models\User::find(1)->first();

            $arArticle = [
                'blog_author_id' => $author->id,
                'created_by_id' => $user->id
            ];

            // Фабрика
            factory(App\Models\Blog\Article::class, rand(1, 10))->create($arArticle)->each(function($article) {
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
