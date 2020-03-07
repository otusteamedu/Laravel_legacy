<?php

namespace App\Services\News\Handlers;

use App\Models\News;
use App\Services\News\Repositories\NewsRepositoryInterface;

/**
 * Class UpdateNewsHandler
 * @package App\Services\News\Handlers
 */
class UpdateNewsHandler {
    private $newsRepository;

    public function __construct(
        NewsRepositoryInterface $newsRepository
    )
    {
        $this->newsRepository = $newsRepository;
    }

    public function handle(News $news, array $data): News
    {
        if (isset($data['name'])) {
            $data['name'] = ucfirst($data['name']);
        }

        if (isset($data['description'])) {
            $data['description'] = trim($data['description']);
        }

        return $this->newsRepository->updateFromArray($news, $data);
    }
}
