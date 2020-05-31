<?php
namespace App\Services\Blog\Author\Repositories;

use App\Models\Blog\BlogAuthor;

interface AuthorRepositoryInterface
{
    public function find(int $id);

    public function search(array $filters = []);

    public function createFromArray(array $data): BlogAuthor;

    public function updateFromArray(BlogAuthor $city, array $data);

}
