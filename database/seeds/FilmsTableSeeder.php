<?php

use Illuminate\Database\Seeder;

class FilmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('films')->insert(
            array(
                array('id' => '1','title' => 'Король скорпионов','meta_description' => 'Король скорпионов', 'keywords'=>'Король скорпионов',
                'slug'=>'korol_skorpionov','status'=>'Опубликовано','content'=>'Описание фильмы', 'role'=>'Царь', 
                'created_at' => '2020-05-20 00:06:04','updated_at' => '2020-05-20 00:08:04'),
            )
        );
    }
}
