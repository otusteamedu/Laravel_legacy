<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('seeds.categories.topics') as $category) {
            $category = factory(App\Models\Category::class)->create($category);
            $images = $this->getAttachData(100);

            $category->images()->attach($images, ['category_type' => 'topics']);
        }

        foreach (config('seeds.categories.colors') as $category) {
            $category = factory(App\Models\Category::class)->create($category);
            $images = $this->getAttachData(300);

            $category->images()->attach($images, ['category_type' => 'colors']);
        }

        foreach (config('seeds.categories.interiors') as $category) {
            $category = factory(App\Models\Category::class)->create($category);
            $images = $this->getAttachData(300);

            $category->images()->attach($images, ['category_type' => 'interiors']);
        }
    }

    /**
     * @param int $count
     * @return mixed
     */
    protected function getAttachData(int $count)
    {
        return Arr::random($this->getRangeImageIds(), $count);
    }

    /**
     * @return array
     */
    protected function getRangeImageIds()
    {
        return range(1, config('seed_settings.images_count'));
    }
}
