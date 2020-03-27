<?php

use Illuminate\Database\Seeder;
use App\Models\Picture;

class PictureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Picture::class, 50)->create();
    }
}
