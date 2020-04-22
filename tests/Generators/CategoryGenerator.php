<?php


namespace Tests\Generators;


use App\Models\Category;

/**
 * Class CategoryGenerator
 * @package Tests\Generators
 */

class CategoryGenerator
{
    /**
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    public function createCategory (array $data = [])
    {
        return factory(Category::class)->create($data);
    }
}
