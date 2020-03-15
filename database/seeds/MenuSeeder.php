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
     */
    public function run()
    {
        factory(Menu::class, 10)->create();
    }
}
