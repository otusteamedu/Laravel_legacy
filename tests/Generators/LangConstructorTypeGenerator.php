<?php


namespace Tests\Generators;


use App\Models\ConstructionType;

class LangConstructorTypeGenerator
{

    public static function createConstructorType(array $data = [])
    {
        return factory(ConstructionType::class)->create($data);
    }
    public static function makeConstructorType(array $data = [])
    {
        return factory(ConstructionType::class)->make($data);
    }
}
