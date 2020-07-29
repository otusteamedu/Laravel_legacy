<?php

namespace App\Services\Posts\Repositories;

use App\DTOs\PostDTO;
use App\DTOs\PostFilterDTO;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Interface PostRepositoryInterface
 * @package App\Services\Posts\Repositories
 */
interface PostRepositoryInterface
{
    /**
     * @param Post $post
     * @return bool
     */
    public function delete(Post $post): bool;

    /**
     * @param PostDTO $postDTO
     * @param Post $post
     * @return Post
     */
    public function update(PostDTO $postDTO, Post $post): Post;

    /**
     * @param PostDTO $DTO
     * @return Post
     */
    public function store(PostDTO $DTO): Post;

    /**
     * @param int $perPage
     * @param PostFilterDTO $DTO
     * @return LengthAwarePaginator
     */
    public function getPostsListPaginate(int $perPage, PostFilterDTO $DTO): LengthAwarePaginator;

    /**
     * @param Post $post
     * @param Carbon|null $date
     * @return Post
     */
    public function publish(Post $post, Carbon $date = null): Post;
}
