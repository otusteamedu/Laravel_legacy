<?php

namespace App\Services\News;


use App\Models\News;
use App\Services\News\Handlers\CreateNewsHandler;
use App\Services\News\Handlers\UpdateNewsHandler;
use App\Services\News\Handlers\DeleteNewsHandler;
use App\Services\News\Repositories\NewsRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class NewsService
{
    private $createNewsHandler;
    private $updateNewsHandler;
    private $deleteNewsHandler;
    private $newsRepository;

    public function __construct(
        CreateNewsHandler $createNewsHandler,
        UpdateNewsHandler $updateNewsHandler,
        DeleteNewsHandler $deleteNewsHandler,
        NewsRepositoryInterface $newsRepository
    )
    {
        $this->createNewsHandler = $createNewsHandler;
        $this->updateNewsHandler = $updateNewsHandler;
        $this->deleteNewsHandler = $deleteNewsHandler;
        $this->newsRepository = $newsRepository;
    }

    /**
     * @param int $id
     * @return News|null
     */
    public function findNews(int $id)
    {
        return $this->newsRepository->find($id);
    }

    /**
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function searchNews(array $filters): LengthAwarePaginator
    {
        return $this->newsRepository->search($filters);
    }

    /**
     * @param array $data
     * @return News
     */
    public function storeNews(array $data): News
    {
        return $this->createNewsHandler->handle($data);
    }

    /**
     * @param News $news
     * @param array $data
     * @return News
     */
    public function updateNews(News $news, array $data): News
    {
        return $this->updateNewsHandler->handle($news, $data);
    }

    /**
     * @param News $news
     */
    public function deleteNews(News $news) {
        return $this->deleteNewsHandler->handle($news);
    }
}
