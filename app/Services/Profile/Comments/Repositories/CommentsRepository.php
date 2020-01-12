<?php


namespace App\Services\Profile\Comments\Repositories;

use App\Models\Comment;
use Illuminate\Support\Facades\DB;


/**
 * Class CommentsRepository
 * @package App\Services\Profile\Repositories
 */
class CommentsRepository
{
    public function updateComment(Comment $comment, $data)
    {
        return $comment->update($data);
    }

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

    public function getCommentById(int $id)
    {
        return Comment::with([
            'author:name,id',
            'target:name,id',
        ])
        ->findOrFail($id);
    }
}
