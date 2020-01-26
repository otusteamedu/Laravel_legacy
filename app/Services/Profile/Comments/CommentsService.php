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
    /**
     * @var UpdateCommentHandler
     */
    private $updateCommentHandler;
    /**
     * @var CommentsRepository
     */
    private $commentRepository;

    /**
     * CommentsService constructor.
     * @param UpdateCommentHandler $updateCommentHandler
     * @param CommentsRepository $commentRepository
     */
    public function __construct(
        UpdateCommentHandler $updateCommentHandler,
        CommentsRepository $commentRepository
    )
    {
        $this->updateCommentHandler = $updateCommentHandler;
        $this->commentRepository = $commentRepository;
    }

    /**
     * @param int $userId
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getCommentsList(int $userId)
    {
        return $this->commentRepository->getCommentsList($userId);
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function getCommentById(int $id)
    {
        return $this->commentRepository->getCommentById($id);
    }

    /**
     * @param Comment $comment
     * @param array $data
     * @return bool
     */
    public function updateCommentData(Comment $comment, array $data)
    {
        return $this->commentRepository->updateComment($comment, $data);
    }
}
