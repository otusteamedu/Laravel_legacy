<?php

use Illuminate\Database\Seeder;
use App\Model\Menu\Link;

/**
 * Class LinkSeeder
 *
 * Заполняет таблицу ссылок меню
 */
class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        factory(Link::class, random_int(7, 10))->state('main')->create();
        factory(Link::class, random_int(10, 15))->state('footer')->create();
    }
}
