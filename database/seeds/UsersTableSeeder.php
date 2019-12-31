<?php

use Illuminate\Database\Seeder;

use Faker\Generator as Faker;//понадобится

class UsersTableSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Команда фабрике : создай 10 пользователей
        $users = factory(App\Models\User::class,10)->create();        
    }
}
