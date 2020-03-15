<?php

namespace App\Repositories\Post\Post;

use App\Models\Post\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Throwable;

interface PostRepositoryInterface
{
    /**
     * Получаем все новости
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Возвращаем список новостей с пагенацией
     * @param array $options
     * @return LengthAwarePaginator
     */
    public function paginationList(array $options = []): LengthAwarePaginator;

    /**
     * Возвращаем список новостей с пагенацией
     * @param array $options
     * @return Collection
     */
    public function list(array $options = []): Collection;

    /**
     * Получаем новость по ID
     * @param int $id
     * @return Post
     */
    public function find(int $id): Post;

    /**
     * Получаем новость по slug
     * @param string $slug
     * @return Post
     */
    public function getBySlug(string $slug): Post;

    /**
     * Создаем новость по параметрам
     * @param array $data
     * @return Post
     * @throws Throwable
     */
    public function createFromArray(array $data): Post;

    /**
     * Обновляем новость
     * @param Post $post
     * @param array $data
     * @return Post
     * @throws Throwable
     */
    public function updateFromArray(Post $post, array $data): Post;

    /**
     * Публикуем новость
     * @param Post $post
     * @param array $data
     * @return Post
     * @throws Throwable
     */
    public function publishedFromArray(Post $post, array $data): Post;

    /**
     * Удаляем новость
     * @param Post $post
     * @throws Throwable
     */
    public function delete(Post $post): void;
}