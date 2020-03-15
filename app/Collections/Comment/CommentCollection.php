<?php

namespace App\Collections\Comment;

use Illuminate\Database\Eloquent\Collection;

class CommentCollection extends Collection
{
    public function threaded(): Collection
    {
        $comments = parent::groupBy('comment_id');

        if (count($comments) && isset($comments[''])) {
            $comments['root'] = $comments[''];
            unset($comments['']);
        }
        return $comments;
    }
}
