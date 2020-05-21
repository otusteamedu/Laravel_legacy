<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    /**
     * Выполнить команду composer dumpautoload
     * Выполнять надо всегда при добавлении нового файла в папку database.
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // error with foreign keys (artisan db:seed)

         $this->call(UsersTableSeeder::class);
         $this->call(DivisionsTableSeeder::class);
         $this->call(TownsTableSeeder::class);
         $this->call(AdvertsTableSeeder::class);
         //$this->call(MessagesTableSeeder::class);
    }
}
