<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Color;
use App\Models\ColorTranslation;

class ColorTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('color_translations')->truncate();

        $colors = Color::all();

        foreach ($colors as $color) {
            $colorTranslation = new ColorTranslation();
            $colorTranslation->color_id = $color->id;
            $colorTranslation->locale = 'ru';
            $colorTranslation->attribute = 'name';
            $colorTranslation->value = $color->name . 'Ru';
            $colorTranslation->save();
        }
    }
}
