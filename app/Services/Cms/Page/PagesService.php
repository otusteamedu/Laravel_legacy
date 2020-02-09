<?php

namespace App\Services\Cms\Page;

use App\Models\Page\Page;
use App\Repositories\Page\PageRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class PageService
 * @package App\Services\Cms\Page
 */
class PagesService
{
    /** @var PageRepositoryInterface  */
    protected $pageRepository;

    /**
     * PagesService constructor.
     * @param PageRepositoryInterface $pageRepository
     */
    public function __construct(PageRepositoryInterface $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function paginationList(): LengthAwarePaginator
    {
        return $this->pageRepository->paginationList([
                     'order' => ['column' => 'id', 'order' => 'asc']
                 ]);
    }

    /**
     * @param array $data
     * @return string
     */
    public function store(array $data): string
    {
        try {
            $page = $this->pageRepository->createFromArray($data);
            $url = route('cms.pages.show', ['page' => $page->id]);
        } catch (\Throwable $exception) {
            $url = route('cms.pages.create');
        }
        return $url;
    }

    /**
     * @param Page $page
     * @param array $data
     * @return string
     */
    public function update(Page $page, array $data): string
    {
        try {
            $this->pageRepository->updateFromArray($page, $data);
            $url = route('cms.pages.show', ['page' => $page->id]);
        } catch (\Throwable $exception) {
            $url = route('cms.pages.edit', ['page' => $page->id]);
        }
        return $url;
    }

    /**
     * @param Page $page
     * @return string
     */
    public function destroy(Page $page): string
    {
        try {
            $this->pageRepository->delete($page);
            $url = route('cms.pages.index');
        } catch (\Throwable $exception) {
            $url = route('cms.pages.show', ['page' => $page->id]);
        }
        return $url;
    }
}
