<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

//use seeds;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(UsersSeeder::class);
        $this->call(GrammarSeeder::class);
        Model::reguard();
    }
}
