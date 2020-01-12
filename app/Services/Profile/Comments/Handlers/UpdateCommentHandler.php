<?php


namespace App\Services\Profile\Comments\Handlers;


use App\Models\Comment;
use App\Services\Profile\Comments\Repositories\CommentsRepository;

class UpdateCommentHandler
{

    public $commentRepository;

    public function __construct(CommentsRepository $repository)
    {
        $this->commentRepository = $repository;
    }

    public function handle(Comment $comment, array $data)
    {
        return $this->commentRepository->updateComment($comment, $data);
    }
}
