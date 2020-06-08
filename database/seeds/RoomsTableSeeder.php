<?php

use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    const COUNT_FLOORS = 5;
    const COUNT_ROOMS_BY_FLOOR = 6;
    const SQUARE_MIN = 10;
    const SQUARE_MAX = 25;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= self::COUNT_FLOORS; $i++) {

            for ($j = 1; $j <= self::COUNT_ROOMS_BY_FLOOR; $j++) {
                $data = [
                    'number' => "$i - $j",
                    'floor' => $i,
                    'square' => $this->getRandomSquare()

                ];
                factory(\App\Models\Room::class)->make($data)->save();
            }
        }
    }

    private function getRandomSquare()
    {
        return random_int(self::SQUARE_MIN, self::SQUARE_MAX);
    }
}
