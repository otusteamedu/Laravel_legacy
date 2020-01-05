<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = \App\Models\Post\Post::all();
        $users = \App\Models\User\User::all();

        /** @var \App\Models\User\User $user */
        foreach ($users as $user) {
            /** @var \App\Models\Post\Post $post */
            foreach ($posts as $post) {
                factory(\App\Models\Post\Comment::class, 5)->create(
                    [
                        'user_id' => $user->id,
                        'post_id' => $post->id,
                    ]
                );
            }
        }

        $comments = \App\Models\Post\Comment::all();
        /** @var \App\Models\Post\Comment $comment */
        foreach ($comments as $comment) {
            $user = $users->random(1)->first();
            factory(\App\Models\Post\Comment::class, 5)->create(
                [
                    'user_id' => $user->id,
                    'post_id' => $comment->post->id,
                    'comment_id' => $comment->id
                ]
            );
        }
    }
}
