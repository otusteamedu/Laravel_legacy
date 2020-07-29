<?php

namespace App\Services\Posts\Handlers;

use App\DTOs\PostDTO;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

/**
 * Class CreatePostHandler
 * @package App\Services\Posts\Handlers
 */
class CreatePostHandler extends BaseHandler
{
    /**
     * @param array $data
     * @return Post
     */
    public function handle(array $data): Post
    {
        $DTO = PostDTO::fromArray(array_merge(
            $data,
            [PostDTO::USER_ID => Auth::id()]
        ));
        $groupsId = $data['groups'];
        $this->checkGroupsId($groupsId);
        $post = $this->repository->store($DTO);
        $post->groups()->sync($groupsId);

        return $post;
    }
}
