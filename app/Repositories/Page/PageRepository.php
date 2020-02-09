<?php

namespace App\Repositories\Page;

use App\Models\Page\Page;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PageRepository implements PageRepositoryInterface
{
    /** @inheritDoc */
    public function all(): Collection
    {
        return Page::all();
    }

    /** @inheritDoc */
    public function paginationList(array $options = []): LengthAwarePaginator
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
        $query = Page::query();
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
    public function find(int $id): Page
    {
        return Page::findOrFail($id);
    }

    /** @inheritDoc */
    public function createFromArray(array $data): Page
    {
        $page = new Page($data);
        $page->saveOrFail($data);
        return $page;
    }

    /** @inheritDoc */
    public function updateFromArray(Page $page, array $data): Page
    {
        $page->update($data);
        return $page;
    }

    /** @inheritDoc */
    public function delete(Page $page):void
    {
        $page->delete();
    }
}