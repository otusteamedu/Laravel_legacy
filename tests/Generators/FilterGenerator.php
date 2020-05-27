<?php


namespace Tests\Generators;


use App\Models\Filter;

class FilterGenerator
{
    public static function createFilterAge(array $data = [])
    {
        return self::createFilter(array_merge([
            'name' => 'Age 18-24',
            'value' => '18-24',
            'filter_type_id' => 1,
            'created_user_id' => 1,
            'description' => 'by Filter Generator'
        ], $data));
    }

    public static function createFilter(array $data = []): Filter
    {
        return factory(Filter::class)->create($data);
    }
}
