<?php

use App\Model\Article\Article;
use App\Model\Article\Tag;
use Illuminate\Database\Seeder;

/**
 * Class TagSeeder
 * Наполняет таблицу тегов
 */
class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $tagList = factory(Tag::class, random_int(25, 35))->create();
    }
}
