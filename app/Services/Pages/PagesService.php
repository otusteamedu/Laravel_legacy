<?php

namespace App\Services\Pages;


use App\Models\Page;
use App\Services\Pages\Handlers\CreatePageHandler;
use App\Services\Pages\Repositories\PageRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PagesService
{

    /** @var PageRepositoryInterface */
    private $pageRepository;
    /** @var CreatePageHandler */
    private $createPageHandler;

    public function __construct(
        CreatePageHandler $createPageHandler,
        PageRepositoryInterface $pageRepository
    )
    {
        $this->createPageHandler = $createPageHandler;
        $this->pageRepository = $pageRepository;
    }

    /**
     * @param int $id
     * @return Page|null
     */
    public function findPage(int $id)
    {
        return $this->pageRepository->find($id);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchPage(): LengthAwarePaginator
    {
        return $this->pageRepository->search();
    }

    /**
     * @param array $data
     * @return Page
     */
    public function createPage(array $data): Page
    {
        return $this->createPageHandler->handle($data);
    }

    /**
     * @param Page $page
     * @param array $data
     * @return Page
     */
    public function updatePage(Page $page, array $data): Page
    {
        return $this->pageRepository->updateFromArray($page, $data);
    }

}
