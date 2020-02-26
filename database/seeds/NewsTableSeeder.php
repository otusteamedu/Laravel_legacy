<?php

use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\File::class, 'file', 10)->create()->each(function($file){
            $file->news()->save(factory(App\Models\News::class)->make());
        });
    }
}
