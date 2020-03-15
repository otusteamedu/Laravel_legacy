<?php

use Illuminate\Database\Seeder;
use App\Model\Menu\Menu;

/**
 * Class MenuSeeder
 *
 * Заполняет таблицу меню
 */
class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        factory(Menu::class, random_int(7,10))->create();
    }
}
