<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class CategoriesTableSeeder extends Seeder
{
    private $faker;

    public function __construct(Faker $faker)
    {
        $this->faker = $faker;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Category::class, 5)->create();
        factory(App\Models\Category::class, 5)->create([
            'type' => 'colors'
        ]);
        factory(App\Models\Category::class, 5)->create([
            'type' => 'placements'
        ]);
    }
}
