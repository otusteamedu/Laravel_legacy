<?php

use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $genresName = [
            'Биографические',
            'Боевики',
            'Вестерны',
            'Военные',
            'Документальные',
            'Детективы',
            'Драмы',
            'Исторические',
            'Комедии',
            'Криминал',
            'Мелодрамы',
            'Приключения',
            'Семейные',
            'Спорт',
            'ТВ-шоу',
            'Триллеры',
            'Ужасы',
            'Фантастика',
            'Фэнтези'
        ];

        foreach ($genresName as $name) {
            factory(\App\Models\Genre::class, 1)->create([
                'name' => $name,
            ]);
        }
    }
}


