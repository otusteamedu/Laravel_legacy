<?php

use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $producers = User::byRole(Role::TEACHER)->get();
        $receivers = User::byRole(Role::STUDENT)->get();

        factory(Post::class, 20)->make()
            ->each(function (Post $post) use ($producers, $receivers): void {
                $post->producer()->associate($producers->random());
                $post->save();

                $post->users()->sync($receivers->shuffle()->take(10));
            });
    }
}
