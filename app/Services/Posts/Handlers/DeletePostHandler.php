<?php

namespace App\Services\Posts\Handlers;

use App\Models\Post;

/**
 * Class DeletePostHandler
 * @package App\Services\Posts\Handlers
 */
class DeletePostHandler extends BaseHandler
{
    /**
     * @param Post $post
     * @return bool
     */
    public function handle(Post $post): bool
    {
        return $this->repository->delete($post);
    }
}
