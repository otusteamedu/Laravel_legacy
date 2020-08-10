<?php

namespace Tests\Generators;

use App\Models\Group;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;

/**
 * Class PostGenerator
 * @package Tests\Generators
 */
class PostGenerator
{
    /**
     * @param bool $published
     * @param array $data
     * @return Post
     */
    public static function generatePublishedPost(bool $published = true, array $data = []): Post
    {
        $post = factory(Post::class)->create([
            'published_at' => $published ? Carbon::yesterday() : null,
            'user_id' => $data['user_id'] ?? User::first()->id,
        ]);
        $post->groups()->sync(Group::first()->id);

        return $post;
    }
}
