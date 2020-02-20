<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class,1)->create([
            'name'=>'admin',
            'email'=>'admin@mail.com',
            'password'=>bcrypt('admin1234'),
            'level'=>1
        ]);

        factory(User::class,1)->create([
            'name'=>'editor',
            'email'=>'editor@mail.com',
            'password'=>bcrypt('editor'),
            'level'=>2
        ]);
    }
}
