<?php

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Comment::class, 200)
            ->make(["user_id" => 1, "complex_id" => 1])
            ->each(function ($comment) {
                $comment->user_id = rand(1,50);
                $comment->complex_id = rand(1,100);
                $comment->save();
            });
    }
}
