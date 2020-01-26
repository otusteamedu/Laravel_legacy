<?php


namespace App\Services\Profile\Comments\Repositories;

use App\Models\Comment;


/**
 * Class CommentsRepository
 * @package App\Services\Profile\Repositories
 */
class CommentsRepository
{
    /**
     * @param Comment $comment
     * @param $data
     * @return bool
     */
    public function updateComment(Comment $comment, $data)
    {
        return $comment->update($data);
    }

    /**
     * @param int $userId
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getCommentsList(int $userId)
    {
        return Comment::with([
            'author:name,id',
            'target:name,id',
        ])
            ->where('author_id', '=', $userId)
            ->orderByDesc('created_at')
            ->paginate(20);
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function getCommentById(int $id)
    {
        return Comment::with([
            'author:name,id',
            'target:name,id',
        ])
            ->findOrFail($id);
    }
}
