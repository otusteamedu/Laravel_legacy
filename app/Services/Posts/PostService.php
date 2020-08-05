<?php

namespace App\Services\Posts;

use App\DTOs\PostFilterDTO;
use App\Jobs\SendNotificationsToStudentJob;
use App\Models\Post;
use App\Services\Posts\Handlers\CreatePostHandler;
use App\Services\Posts\Handlers\DeletePostHandler;
use App\Services\Posts\Handlers\UpdatePostHandler;
use App\Services\Posts\Repositories\PostRepositoryInterface;
use App\Services\Helpers\DTOHelper;
use App\Services\Helpers\Settings;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Class PostService
 * @package App\Services\Posts
 */
class PostService
{
    /** @var  PostRepositoryInterface */
    protected $repository;
    /** @var CreatePostHandler */
    protected $createPostHandler;
    /** @var UpdatePostHandler */
    protected $updatePostHandler;
    /** @var DeletePostHandler */
    protected $deletePostHandler;

    /**
     * PostService constructor.
     * @param PostRepositoryInterface $repository
     * @param CreatePostHandler $createPostHandler
     * @param UpdatePostHandler $updatePostHandler
     * @param DeletePostHandler $deletePostHandler
     */
    public function __construct(
        PostRepositoryInterface $repository,
        CreatePostHandler $createPostHandler,
        UpdatePostHandler $updatePostHandler,
        DeletePostHandler $deletePostHandler
    ) {
        $this->repository = $repository;
        $this->createPostHandler = $createPostHandler;
        $this->updatePostHandler = $updatePostHandler;
        $this->deletePostHandler = $deletePostHandler;
    }

    /**
     * Список групп с пагинацией
     * @param PostFilterDTO $DTO
     * @return LengthAwarePaginator
     */
    public function paginate(PostFilterDTO $DTO): LengthAwarePaginator
    {
        $perPage = $DTO->toArray()[PostFilterDTO::LIMIT] ?? Settings::PER_PAGE;

        return $this->repository->getPostsListPaginate($perPage, $DTO);
    }

    /**
     * Названия колонок для списка групп
     * @return array
     */
    public function getTableTitles(): array
    {
        return [
            __('scheduler.id'),
            __('scheduler.title'),
            __('scheduler.groups'),
            __('scheduler.published_at'),
        ];
    }

    /**
     * @param array $data
     * @return Post
     */
    public function store(array $data): Post
    {
        return $this->createPostHandler->handle($data);
    }

    /**
     * @param array $data
     * @param Post $post
     * @return Post
     */
    public function update(array $data, Post $post): Post
    {
        return $this->updatePostHandler->handle($data, $post);
    }

    /**
     * @param Post $post
     * @return bool
     */
    public function delete(Post $post): bool
    {
        return $this->deletePostHandler->handle($post);
    }

    /**
     * @param array $ids
     * @return Collection
     */
    public function getIdsFromArray(array $ids): Collection
    {
        return DTOHelper::getIdsDTOFromArray($ids);
    }

    /**
     * @param Post $post
     * @return Post
     */
    public function send(Post $post): Post
    {
        $post = $this->repository->publish($post);

        SendNotificationsToStudentJob::dispatch($post);

        return $post;
    }
}
