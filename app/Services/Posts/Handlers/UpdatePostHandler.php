<?php

namespace App\Services\Posts\Handlers;

use App\DTOs\PostDTO;
use App\Models\Post;

/**
 * Class UpdatePostHandler
 * @package App\Services\Posts\Handlers
 */
class UpdatePostHandler extends BaseHandler
{
    /**
     * @param array $data
     * @param Post $post
     * @return Post
     */
    public function handle(array $data, Post $post): Post
    {
        $DTO = PostDTO::fromArray(array_merge(
            $data,
            [PostDTO::USER_ID => $post->user_id]
        ));
        $groupsId = $data['groups'];
        $this->checkGroupsId($groupsId);
        $post = $this->repository->update($DTO, $post);

        $post->groups()->sync($groupsId);

        return $post;
    }
}
