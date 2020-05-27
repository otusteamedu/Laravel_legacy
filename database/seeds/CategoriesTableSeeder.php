<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values = [
            'incidents' => 'Происшествия',
            'politic' => 'Политика',
            'social' => 'Общество',
            'culture' => 'Культура',
            'travelling' => 'Путешествия',
            'science' => 'Наука',
            'art' => 'Исскуство',
            'sport' => 'Спорт',
        ];

        foreach ($values as $name => $title) {
            $category = [
                'name' => $name,
                'title' => $title
            ];
            Category::updateOrInsert(['name' => $name], $category);
        }
    }
}
