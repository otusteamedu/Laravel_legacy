<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ActorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Actor::class, 10)->create();
    }
}
