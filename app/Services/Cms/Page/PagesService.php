<?php

namespace App\Services\Cms\Page;

use App\Models\Page\Page;
use App\Repositories\Page\PageRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * Class PageService
 * @package App\Services\Cms\Page
 */
class PagesService
{
    /** @var PageRepositoryInterface  */
    protected $pageRepository;

    /** @var string */
    protected $locale;

    /**
     * PagesService constructor.
     * @param PageRepositoryInterface $pageRepository
     */
    public function __construct(PageRepositoryInterface $pageRepository)
    {
        $this->pageRepository = $pageRepository;
        $this->locale = \App::getLocale();
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
            Log::info(
                __('log.info.create.page'),
                [
                    'id' => $page->id,
                    'name' => $page->name,
                    'user' => Auth::user()->id,
                ]
            );
            $url = route('cms.pages.show', [
                'page' => $page->id,
                'locale' => $this->locale,
            ]);
        } catch (\Throwable $exception) {
            Log::critical(
                __('log.critical.notCreate.page'),
                [
                    'exception' => $exception->getMessage(),
                    'data' => $data,
                    'user' => Auth::user()->id,
                ]
            );
            $url = route('cms.pages.create', [
                'locale' => $this->locale,
            ]);
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
            Log::info(
                __('log.info.update.page'),
                [
                    'id' => $page->id,
                    'name' => $page->name,
                    'user' => Auth::user()->id,
                ]
            );
            $url = route('cms.pages.show', [
                'page' => $page->id,
                'locale' => $this->locale,
            ]);
        } catch (\Throwable $exception) {
            Log::critical(
                __('log.critical.notUpdate.page'),
                [
                    'exception' => $exception->getMessage(),
                    'id' => $page->id,
                    'data' => $data,
                    'user' => Auth::user()->id,
                ]
            );
            $url = route('cms.pages.edit', [
                'page' => $page->id,
                'locale' => $this->locale,
            ]);
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
            Log::info(
                __('log.info.destroy.page'),
                [
                    'id' => $page->id,
                    'name' => $page->name,
                    'user' => Auth::user()->id,
                ]
            );
            $url = route('cms.pages.index', [
                'locale' => $this->locale,
            ]);
        } catch (\Throwable $exception) {
            Log::critical(
                __('log.critical.notDestroy.page'),
                [
                    'exception' => $exception->getMessage(),
                    'data' => $page->id,
                    'user' => Auth::user()->id,
                ]
            );
            $url = route('cms.pages.show', [
                'page' => $page->id,
                'locale' => $this->locale,
            ]);
        }
        return $url;
    }
}
