<?php

use Illuminate\Database\Seeder;
use \App\Models\Blog\Category,
    \App\Models\Blog\Article,
    \App\Models\Blog\Author;

class BlogSeeder extends Seeder
{
    /**z
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Сидим категории
        $this->call(BlogCategorySeeder::class);
        // Сидим авторов
        $this->call(BlogAuthorSeeder::class);
        //Силим посты
        $this->call(BlogArticleTableSeeder::class);
    }
}
