<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var \App\Models\User\User $user */
        foreach (\App\Models\User\User::all() as $user) {
            factory(\App\Models\Post\Post::class, 5)->create(
                [
                    'user_id' => $user->id,
                ]
            );
        }

        $rubrics = \App\Models\Post\Rubric::all();
        $posts = \App\Models\Post\Post::all();
        foreach ($posts as $post) {
            $postRubrics = $rubrics->random(rand(1,4));
            /** @var \App\Models\Post\Rubric $rubric */
            foreach ($postRubrics as $rubric) {
                $post->rubrics()->attach($rubric->id);
            }
        }
    }
}
