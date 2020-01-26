<?php


namespace App\Services\Profile\Comments\Handlers;


use App\Models\Comment;
use App\Services\Profile\Comments\Repositories\CommentsRepository;

/**
 * Class UpdateCommentHandler
 * @package App\Services\Profile\Comments\Handlers
 */
class UpdateCommentHandler
{

    /**
     * @var CommentsRepository
     */
    public $commentRepository;

    /**
     * UpdateCommentHandler constructor.
     * @param CommentsRepository $repository
     */
    public function __construct(CommentsRepository $repository)
    {
        $this->commentRepository = $repository;
    }

    /**
     * @param Comment $comment
     * @param array $data
     * @return bool
     */
    public function handle(Comment $comment, array $data)
    {
        return $this->commentRepository->updateComment($comment, $data);
    }
}
