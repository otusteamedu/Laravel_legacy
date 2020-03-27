<?php

use App\Models\Event;
use App\Models\Picture;
use App\Models\EventPicture;
use Illuminate\Database\Seeder;

class EventPictureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 50; $i++) {
            factory(EventPicture::class, 1)->create([
                'event_id' => Event::all()->random()->id,
                'picture_id' => Picture::all()->random()->id,
            ]);
        }
    }
}
