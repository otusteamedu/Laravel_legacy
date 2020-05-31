<?php


namespace App\Services\Blog\Author\Repositories;


use App\Models\Blog\BlogAuthor;
use App\Models\File;
use Illuminate\Database\Eloquent\Builder;

class EloquentAuthorRepository
{
    public function find(int $id)
    {
        return BlogAuthor::find($id);
    }

    public function search(array $filters = [])
    {
        $query = BlogAuthor::query();
        $this->applyFilters($query, $filters);
        return $query->paginate();
    }

    public function createFromArray(array $data): BlogAuthor
    {
        $city = new BlogAuthor();
        $city->create($data);
        return $city;
    }

    public function updateFromArray(BlogAuthor $blogAuthor, array $data)
    {
        $blogAuthor->update($data);
        return $blogAuthor;
    }

    private function applyFilters(Builder $builder, array $filters)
    {
        if (isset($filters['name'])) {
            $builder->where('name', $filters['name']);
        }
    }
}
