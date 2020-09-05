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
    const CACHE_KEY = 'ARTICLE';
    const CACHE_TAG_NAME = 'ARTICLES';
    const CACHE_TTL = 60;

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
     * @param string $resourceCacheKey
     * @return mixed
     */
    public function paginated(array $options = null, $resourceCacheKey)
    {
        $arg_list = func_get_args();
        $mixedCacheKey = $this->getMixedCacheKey($arg_list);

        $articles = \Cache::tags(self::CACHE_TAG_NAME)->remember($this->getCacheKey('LIST' . $mixedCacheKey),
            Carbon::now()->addMinutes(self::CACHE_TTL), function () use ($options) {
                return $this->articleRepository->paginated($options);
            });
        return $articles;
    }

    /**
     * @param array $criterias
     * @param $resourceCacheKey
     * @param int|null $limit
     * @param int $page
     * @return Article[]|Collection|null
     */
    public function findBy(array $criterias, $resourceCacheKey, $limit = null, $page = 1)
    {
        if (!isset($criterias)) {
            throw new \InvalidArgumentException('criteria is required');
        }
        $arg_list = func_get_args();

        $mixedCacheKey = $this->getMixedCacheKey($arg_list);
        $articles = \Cache::tags(self::CACHE_TAG_NAME)->remember($this->getCacheKey($resourceCacheKey . 'FINDBY' . $mixedCacheKey),
            Carbon::now()->addMinutes(self::CACHE_TTL), function () use ($criterias, $limit) {
                return Article::where($criterias)->orderBy('id', 'desc')->paginate($limit);
            });
        return $articles;
    }

    /**
     * @param $prefix
     * @return string
     */
    public function getCacheKey($prefix)
    {
        return $prefix . '_' . self::CACHE_KEY;
    }

    /**
     * Очистка кэша
     */
    public function clear()
    {
        \Cache::tags(self::CACHE_TAG_NAME)->flush();
    }

    public function getMixedCacheKey(array $options)
    {
        $mixedCacheKey = '_';
        array_walk_recursive($options, function ($option, $optionKey) use (&$mixedCacheKey) {
            $mixedCacheKey .= strtoupper($optionKey . '_' . $option);
            return $mixedCacheKey;
        });

        return $mixedCacheKey;
    }
}
