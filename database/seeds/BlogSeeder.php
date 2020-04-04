<?php

use Illuminate\Database\Seeder;

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

        //Сидим посты
        $this->call(BlogArticleSeeder::class);
    }
}
