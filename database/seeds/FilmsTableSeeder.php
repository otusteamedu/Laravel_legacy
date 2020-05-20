<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                array('id' => '1','title' => 'Король скорпионов', 'meta_title'=> 'Король скорпионов','meta_description' => 'Король скорпионов', 'keywords'=>'Король скорпионов',
                'slug'=>'korol_skorpionov','status'=>'Опубликовано','content'=>'Описание фильма', 'role'=>'Царь',
                'created_at' => '2020-05-20 00:06:04','updated_at' => '2020-05-20 00:08:04'),
                array('id' => '2','title' => 'Король скорпионов 2', 'meta_title'=> 'Король скорпионов 2','meta_description' => 'Король скорпионов 2', 'keywords'=>'Король скорпионов 2',
                'slug'=>'korol_skorpionov_2','status'=>'Опубликовано','content'=>'Описание фильма', 'role'=>'Царь',
                'created_at' => '2020-05-20 00:06:04','updated_at' => '2020-05-20 00:08:04'),
                array('id' => '3','title' => 'Король скорпионов 3', 'meta_title'=> 'Король скорпионов 3','meta_description' => 'Король скорпионов 3', 'keywords'=>'Король скорпионов 3',
                'slug'=>'korol_skorpionov_3','status'=>'Опубликовано','content'=>'Описание фильма', 'role'=>'Царь',
                'created_at' => '2020-05-20 00:06:04','updated_at' => '2020-05-20 00:08:04')
            )
        );
    }
}
