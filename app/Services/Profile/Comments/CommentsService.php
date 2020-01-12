<?php


namespace App\Services\Profile\Comments;


use App\Models\Comment;
use App\Services\Profile\Comments\Handlers\UpdateCommentHandler;
use App\Services\Profile\Comments\Repositories\CommentsRepository;

/**
 * Class CommentsService
 * @package App\Services\Profile\Comments
 */
class CommentsService
{
    private $updateCommentHandler;
    private $commentRepository;

    public function __construct(
        UpdateCommentHandler $updateCommentHandler,
        CommentsRepository $commentRepository
    )
    {
        $this->updateCommentHandler = $updateCommentHandler;
        $this->commentRepository = $commentRepository;
    }

    public function getCommentsList()
    {
        return $this->commentRepository->getCommentsList();
    }

    public function getCommentById(int $id)
    {
        return $this->commentRepository->getCommentById($id);
    }

    public function updateCommentData(Comment $comment, array $data)
    {
        return $this->commentRepository->updateComment($comment, $data);
    }
}
