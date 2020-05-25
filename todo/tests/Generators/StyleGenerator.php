<?php

namespace Tests\Generators;

use App\Models\Style;



class StyleGenerator
{
    public static function createStyle(array $data = [])
    {
        return factory(Style::class, 1)->create(['style_id' => $data['style_id']]);
        factory(Instructor::class, 1)->create(['instructor_id' => $data['instructor_id']]);
    }
}