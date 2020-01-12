<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            //доходы
            ['id' => 1, 'name' => 'Зарплата', 'type' => '1', 'parent_id' => NULL, 'img' => ''],
            ['id' => 2, 'name' => 'Подарки', 'type' => '1', 'parent_id' => NULL, 'img' => ''],
            ['id' => 3, 'name' => 'Премии', 'type' => '1', 'parent_id' => NULL, 'img' => ''],
            ['id' => 4, 'name' => 'Продавать', 'type' => '1', 'parent_id' => NULL, 'img' => ''],
            ['id' => 5, 'name' => 'Проценты', 'type' => '1', 'parent_id' => NULL, 'img' => ''],
            ['id' => 6, 'name' => 'Прочее', 'type' => '1', 'parent_id' => NULL, 'img' => ''],

            //расходы
            ['id' => 7, 'name' => 'Продукты', 'type' => '0', 'parent_id' => NULL, 'img' => ''],
            ['id' => 8, 'name' => 'ЖКХ', 'type' => '0', 'parent_id' => NULL, 'img' => ''],
            ['id' => 9, 'name' => 'Одежда', 'type' => '0', 'parent_id' => NULL, 'img' => ''],
            ['id' => 10, 'name' => 'Развитие ребенка', 'type' => '0', 'parent_id' => NULL, 'img' => ''],
            ['id' => 11, 'name' => 'Непредвиденные расходы', 'type' => '0', 'parent_id' => NULL, 'img' => ''],
            ['id' => 12, 'name' => 'Здоровье', 'type' => '0', 'parent_id' => NULL, 'img' => ''],
            ['id' => 13, 'name' => 'Лекарства', 'type' => '0', 'parent_id' => 12, 'img' => ''],
            ['id' => 14, 'name' => 'Химия + бытовое', 'type' => '0', 'parent_id' => NULL, 'img' => ''],
            ['id' => 15, 'name' => 'Развлечения', 'type' => '0', 'parent_id' => NULL, 'img' => ''],
            ['id' => 16, 'name' => 'Автомобиль', 'type' => '0', 'parent_id' => NULL, 'img' => ''],
            ['id' => 17, 'name' => 'Проезд', 'type' => '0', 'parent_id' => NULL, 'img' => ''],
        ]);
    }
}
