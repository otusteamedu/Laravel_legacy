<?php

use Illuminate\Database\Seeder;

class SegmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $segments = [
            'Рекламная кампания Директ',
            'Рекламная кампания Адвордс',
            'Рекламная кампания Партнерские сети',
            'Рекламная кампания Оффлайн',
        ];

        foreach ($segments as $segment)
            DB::table('segments')->insert([
                'name' => $segment,
                'condition' => Str::random(100),
                'created_at' => now(),
            ]);
    }

}
