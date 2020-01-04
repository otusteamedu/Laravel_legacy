<?php

use Illuminate\Database\Seeder;

class TexturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Texture::class, 10)->create();
    }
}
