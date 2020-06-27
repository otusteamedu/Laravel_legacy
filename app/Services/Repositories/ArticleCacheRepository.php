<?php

namespace App\Services\Repositories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

/**
 * Репозиторий для работы с cache
 *
 * Class ArticleCacheRepository
 * @package App\Services\Repositories
 */
class ArticleCacheRepository
{
    const CASH_KEY = 'ARTICLE';
    const CASH_TAG_NAME = 'ARTICLES';
    const CASH_TTL = 60;

    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    /**
     * ArticleCacheRepository constructor.
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * @param array|null $options
     * @return mixed
     */
    public function paginated(array $options = null)
    {
        $articles = \Cache::tags(self::CASH_TAG_NAME)->remember(self::getCacheKey('LIST'), Carbon::now()->addMinutes(self::CASH_TTL), function () use ($options) {
            return $this->articleRepository->paginated($options);
        });
        return $articles;
    }

    /**
     * @param $prefix
     * @return string
     */
    public static function getCacheKey($prefix)
    {
        return $prefix . '_' . self::CASH_KEY;
    }

    /**
     * Очистка кэша
     */
    public function clear()
    {
        \Cache::tags(self::CASH_TAG_NAME)->flush();
    }
}
