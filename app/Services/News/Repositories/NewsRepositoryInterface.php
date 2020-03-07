<?php

namespace App\Services\News\Repositories;


use App\Models\News;

/**
 * Interface NewsRepositoryInterface
 * @package App\Services\News\Repositories
 */
interface NewsRepositoryInterface
{
    public function find(int $id);

    public function search(array $filters = []);

    public function createFromArray(array $data): News;

    public function updateFromArray(News $news, array $data);

    public function delete(int $id);
}
