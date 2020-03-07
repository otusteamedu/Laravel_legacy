<?php

namespace App\Services\News\Handlers;

use App\Models\News;
use App\Services\News\Repositories\NewsRepositoryInterface;
use Carbon\Carbon;

/**
 * Class CreateNewsHandler
 * @package App\Services\News\Handlers
 */
class CreateNewsHandler {
    private $newsRepository;

    public function __construct(
        NewsRepositoryInterface $newsRepository
    )
    {
        $this->newsRepository = $newsRepository;
    }

    public function handle(array $data): News
    {
        $data['created_at'] = Carbon::create()->subDay();
        $data['name'] = ucfirst($data['name']);
        $data['description'] = trim($data['description']);

        return $this->newsRepository->createFromArray($data);
    }
}
