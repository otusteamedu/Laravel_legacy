<?php

namespace App\Repositories\Post\Comment;

use App\Models\Post\Comment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Throwable;

/**
 * Interface CommentRepositoryInterface
 * @package App\Repositories\Post\Comment
 */
interface CommentRepositoryInterface
{
    /**
     * Получаем все комментарии
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Возвращаем список комментариев с пагенацией
     * @param array $options
     * @return LengthAwarePaginator
     */
    public function paginationList(array $options): LengthAwarePaginator;

    /**
     * Возвращаем список комментариев
     * @param array $options
     * @return Collection
     */
    public function list(array $options): Collection;

    /**
     * Получаем комментарий по ID
     * @param int $id
     * @return Comment
     */
    public function find(int $id): Comment;

    /**
     * Создаем комментарий по параметрам
     * @param array $data
     * @return Comment
     * @throws Throwable
     */
    public function createFromArray(array $data): Comment;

    /**
     * Обновляем комментарий
     * @param Comment $comment
     * @param array $data
     * @return Comment
     * @throws Throwable
     */
    public function updateFromArray(Comment $comment, array $data): Comment;

    /**
     * Удаляем комментарий
     * @param Comment $comment
     * @throws Throwable
     */
    public function delete(Comment $comment): void;
}