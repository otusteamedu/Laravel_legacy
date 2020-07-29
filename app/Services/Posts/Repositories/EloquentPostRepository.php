<?php

namespace App\Services\Posts\Repositories;

use App\DTOs\PostDTO;
use App\DTOs\PostFilterDTO;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

/**
 * Class EloquentPostRepository
 * @package App\Services\Posts\Repositories
 */
class EloquentPostRepository implements PostRepositoryInterface
{
    /**
     * @param Post $post
     * @return bool
     * @throws \Exception
     */
    public function delete(Post $post): bool
    {
        return $post->delete();
    }

    /**
     * @param PostDTO $postDTO
     * @param Post $post
     * @return Post
     */
    public function update(PostDTO $postDTO, Post $post): Post
    {
        $post->update($postDTO->toArray());

        return $post;
    }

    /**
     * @param PostDTO $DTO
     * @return Post
     */
    public function store(PostDTO $DTO): Post
    {
        return Post::create($DTO->toArray());
    }

    /**
     * Список групп с пагинацией
     * @param int $perPage
     * @param PostFilterDTO $DTO
     * @return LengthAwarePaginator
     */
    public function getPostsListPaginate(int $perPage, PostFilterDTO $DTO): LengthAwarePaginator
    {
        $builder = $this->selectRequiredColumns(Post::query())
            ->with([
                'groups',
            ]);
            $builder = $this->filter($builder, $DTO);
            $builder->orderBy('published_at', 'DESC');

        $paginator = $this->paginate($builder, $perPage);

        return $paginator;
    }

    /**
     * Фильтрует список групп
     * @param Builder $builder
     * @param PostFilterDTO $DTO
     * @return Builder
     */
    private function filter(Builder $builder, PostFilterDTO $DTO): Builder
    {
        $filters = $DTO->toArray();
        if ($postNumber = $filters[PostFilterDTO::TITLE]) {
            $builder->byTitle($postNumber);
        }
        if ($groups = $filters[PostFilterDTO::GROUPS]) {
            $builder->byGroups($groups);
        }
        if ($isPublished = $filters[PostFilterDTO::PUBLISHED]) {
            $builder->isPublished();
        }

        return $builder;
    }

    /**
     * @param Builder $builder
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    private function paginate(Builder $builder, int $perPage): LengthAwarePaginator
    {
        return $builder->paginate($perPage);
    }

    /**
     * @param Builder $builder
     * @param array|null $columns
     * @return Builder
     */
    private function selectRequiredColumns(Builder $builder, array $columns = null): Builder
    {
        if (!$columns) {
            $columns = [
                'id',
                'title',
                'published_at',
                'user_id',
            ];
        }
        $builder->select($columns);

        $user = Auth::user();
        if (!$user->isAdmin()) {
            $builder->where('user_id', $user->id);
        }

        return $builder;
    }

    /**
     * @param Post $post
     * @param Carbon|null $date
     * @return Post
     */
    public function publish(Post $post, Carbon $date = null): Post
    {
        $post->published_at = $date ?? now();
        $post->save();

        return $post;
    }
}
