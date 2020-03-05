<?php
/**
 * Description of NewsService.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\News;


use App\Services\News\Clients\NewsClientInterface;
use App\Services\News\Repositories\NewsRepositoryInterface;

class NewsService
{

    private $newsRepository;

    public function __construct(
        NewsRepositoryInterface $newsRepository
    )
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     * @return array
     */
    public function getLatest(): array
    {
        return $this->newsRepository->latest();
    }

}
