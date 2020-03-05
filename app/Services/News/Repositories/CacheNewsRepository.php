<?php
/**
 * Description of CacheNewsRepository.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\News\Repositories;


use App\Services\Cache\Key;
use Cache;
use App\Services\News\Clients\NewsClientInterface;

class CacheNewsRepository implements NewsRepositoryInterface
{
    const LATEST_TTL_HOUR = 3600;

    /** @var NewsClientInterface */
    private $newsClient;

    public function __construct(
        NewsClientInterface $newsClient
    )
    {
        $this->newsClient = $newsClient;
    }

    /**
     * @return array
     */
    public function latest(): array
    {
        return Cache::remember(
            Key::NEWS_API_LATEST_KEY,
                self::LATEST_TTL_HOUR,
                function () {
                    return $this->newsClient->latest();
                }
            );
    }

}
