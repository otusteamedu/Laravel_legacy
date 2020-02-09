<?php

namespace App\Services\Cms\Post;

use App\Models\Post\Comment;
use App\Repositories\Post\Comment\CommentRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class CommentsService
 * @package App\Services\Cms\Post
 */
class CommentsService
{
    /** @var CommentRepositoryInterface $rubricRepository */
    protected $commentRepository;

    /**
     * RubricsService constructor.
     * @param CommentRepositoryInterface $commentRepository
     */
    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function paginationList(): LengthAwarePaginator
    {
        return $this->commentRepository->paginationList([
            'with' => 'post',
            'order' => ['column' => 'id', 'order' => 'asc'],
        ]);
    }

    /**
     * @param Comment $comment
     * @param array $data
     * @return string
     */
    public function update(Comment $comment, array $data): string
    {
        try {
            $this->commentRepository->updateFromArray($comment, $data);
            $url = route('cms.comments.show', ['comment' => $comment->id]);
        } catch (\Throwable $exception) {
            $url = route('cms.comments.show', ['comment' => $comment->id]);
        }
        return $url;
    }

    /**
     * @param Comment $comment
     * @return string
     */
    public function destroy(Comment $comment): string
    {
        try {
            $this->commentRepository->delete($comment);
            $url = route('cms.comments.index');
        } catch (\Throwable $exception) {
            $url = route('cms.comments.show', ['comment' => $comment->id]);
        }
        return $url;
    }
}