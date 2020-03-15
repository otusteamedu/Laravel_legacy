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

    /** @inheritDoc */
    public function list(array $options): Collection
    {
        $query = $this->buildQuery($options);
        return $query->get();
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
                case 'where':
                    $query = $this->buildWhere($query, $value);
                    break;
                case 'order':
                    foreach ($value as $order) {
                        $query->orderBy($order['column'], $order['order']);
                    }
                    break;
            }
        }
        return $query;
    }

    /**
     * @param Builder $query
     * @param array $value
     * @return Builder
     */
    protected function buildWhere(Builder $query, array $value): Builder
    {
        foreach ($value as $where) {
            switch ($where['action']) {
                case 'IN':
                    $query->whereIn($where['column'], $where['value']);
                    break;
                case 'NOT_IN':
                    $query->whereNotIn($where['column'], $where['value']);
                    break;
                case 'NULL':
                    $query->whereNull($where['column']);
                    break;
                case 'NOT_NULL':
                    $query->whereNotNull($where['column']);
                    break;
                case 'HAS':
                    $query->whereHas(
                        $where['relation'],
                        function (Builder $builder) use ($where) {
                            $this->buildWhere($builder, $where['where']);
                        }
                    );
                    break;
                default:
                    $query->where(
                        $where['column'],
                        $where['action'],
                        $where['value']
                    );
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