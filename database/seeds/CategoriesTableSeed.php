<?php
use Faker\Generator as FakerGenerator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class CategoriesTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(FakerGenerator $faker)
    {
        DB::table('categories')->insert([
            'parent_id' => 0,
            'icon' => $faker->url,
            'slug' => Str::slug('Одежда, обувь и аксессуары'),
            'title' => 'Одежда, обувь и аксессуары',
            'description' => 'Одежда, обувь и аксессуары',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('categories')->insert([
            'parent_id' => 0,
            'icon' => $faker->url,
            'slug' => Str::slug('Детские товары'),
            'title' => 'Детские товары',
            'description' => 'Детские товары',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('categories')->insert([
            'parent_id' => 0,
            'icon' => $faker->url,
            'slug' => Str::slug('Аптека'),
            'title' => 'Аптека',
            'description' => 'Аптека',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('categories')->insert([
            'parent_id' => 0,
            'icon' => $faker->url,
            'slug' => Str::slug('Продукты питания'),
            'title' => 'Продукты питания',
            'description' => 'Продукты питания',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('categories')->insert([
            'parent_id' => 0,
            'icon' => $faker->url,
            'slug' => Str::slug('Товары для животных'),
            'title' => 'Товары для животных',
            'description' => 'Товары для животных',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('categories')->insert([
            'parent_id' => 0,
            'icon' => $faker->url,
            'slug' => Str::slug('Бытовая химия'),
            'title' => 'Бытовая химия',
            'description' => 'Бытовая химия',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
