<?php

namespace App\Services\Pages\Repositories;


use App\Models\Page;
use Illuminate\Database\Eloquent\Builder;

class EloquentPageRepository implements PageRepositoryInterface
{
    public function find(int $id)
    {
        return Page::find($id);
    }

    public function search(array $filters = [])
    {
        $query = Page::query();
        $this->applyFilters($query, $filters);
        return $query->paginate();
    }

    public function createFromArray(array $data): Page
    {
        $page = new Page();
        $page->create($data);
        return $page;
    }

    public function updateFromArray(Page $page, array $data)
    {
        $page->update($data);
        return $page;
    }

    private function applyFilters(Builder $builder, array $filters)
    {
        if (isset($filters['name'])) {
            $builder->where('name', $filters['name']);
        }
    }
}
