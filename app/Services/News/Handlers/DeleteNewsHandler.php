<?php

namespace App\Services\News\Handlers;

use App\Models\News;
use App\Services\News\Repositories\NewsRepositoryInterface;

/**
 * Class DeleteNewsHandler
 * @package App\Services\News\Handlers
 */
class DeleteNewsHandler {
    private $newsRepository;

    public function __construct(
        NewsRepositoryInterface $newsRepository
    )
    {
        $this->newsRepository = $newsRepository;
    }

    public function handle(News $news): void
    {
        $news->delete();
    }
}
