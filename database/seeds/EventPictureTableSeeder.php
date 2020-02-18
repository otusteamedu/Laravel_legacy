<?php

use Illuminate\Database\Seeder;
use App\Models\EventPicture;

class EventPictureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(EventPicture::class, 100)->create();
    }
}
