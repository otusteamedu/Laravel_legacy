<?php

use Illuminate\Database\Seeder;

class ArticleCommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Для каждой статьи создаем от 0-10 комментариев
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Models\Article::all() as $article) {
            factory(\App\Models\ArticleComment::class, rand(0, 10))->create(['article_id' => $article->id]);
        }
    }
}
