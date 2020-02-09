<?php

namespace App\Repositories\Post\Comment;

use App\Models\Post\Comment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Throwable;

class CommentRepository implements CommentRepositoryInterface
{
    /** @inheritDoc */
    public function all(): Collection
    {
        return Comment::all();
    }

    /** @inheritDoc */
    public function paginationList(array $options): LengthAwarePaginator
    {
        $query = $this->buildQuery($options);
        return $query->paginate();
    }

    /**
     * @param array $options
     * @return Builder
     */
    protected function buildQuery(array $options): Builder
    {
        $query = Comment::query();
        foreach ($options as $key=>$value) {
            switch ($key) {
                case 'with':
                    $query->with($value);
                    break;
                case 'order':
                    $query->orderBy($value['column'], $value['order']);
                    break;
            }
        }
        return $query;
    }

    /** @inheritDoc */
    public function find(int $id): Comment
    {
        return Comment::findOrFail($id);
    }

    /** @inheritDoc */
    public function createFromArray(array $data): Comment
    {
        $comment = new Comment($data);
        $comment->saveOrFail($data);
        return $comment;
    }

    /** @inheritDoc */
    public function updateFromArray(Comment $comment, array $data): Comment
    {
        $comment->update($data);
        return $comment;
    }

    /** @inheritDoc */
    public function delete(Comment $comment):void
    {
        $comment->delete();
    }
}