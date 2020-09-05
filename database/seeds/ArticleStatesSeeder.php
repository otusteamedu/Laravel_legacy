<?php

use Illuminate\Database\Seeder;
use App\Models\ArticleState;

class ArticleStatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values = [
            'Черновик',
            'Ожидание публикации',
            'Опубликована'
        ];

        foreach ($values as $value) {
            $row = [
                'name' => $value,
            ];
            ArticleState::updateOrInsert(['name' => $value], $row);
        }
    }
}
