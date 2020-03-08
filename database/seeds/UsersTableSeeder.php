<?php

use App\User;
use App\Post;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* factory(User::class, 5)->create()->each(function ($user) { */
        /*     $user->posts()->save(factory(Post::class)->make()); */
        /* }); */
        factory(User::class, 5)->create();
    }
}
