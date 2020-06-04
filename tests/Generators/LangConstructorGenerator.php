<?php


namespace Tests\Generators;


use App\Models\Construction;

class LangConstructorGenerator
{

    public static function createConstructor(array $data = [])
    {
        return factory(Construction::class)->create($data);
    }

    public static function makeConstructor(array $data = [])
    {
        return factory(Construction::class)->make($data);
    }
}
