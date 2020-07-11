<?php

namespace App\Services\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

/**
 * Репозиторий для работы с cache
 *
 * Class CategoryCacheRepository
 * @package App\Services\Repositories
 */
class CategoryCacheRepository
{
    const CACHE_KEY = 'CATEGORY';
    const CACHE_TAG_NAME = 'CATEGORIES';
    const CACHE_TTL = 60;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * CategoryCacheRepository constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param array|null $options
     * @return mixed
     */
    public function paginated(array $options = null)
    {
        $categories = \Cache::tags(self::CACHE_TAG_NAME)->remember(self::getCacheKey('LIST'), Carbon::now()->addMinutes(self::CACHE_TTL), function () use ($options) {
            return $this->categoryRepository->paginated($options);
        });
        return $categories;
    }

    /**
     * @param array|null $options
     * @return array
     */
    public function getList(array $options = null)
    {
        $categories = \Cache::tags(self::CACHE_TAG_NAME)->remember($this->getCacheKey('LIST'), Carbon::now()->addMinutes(self::CACHE_TTL), function () use ($options) {
            return $this->categoryRepository->getAll(['id', 'title']);
        });
        $categoryList = [];
        foreach ($categories as $category) {
            $categoryList[$category->id] = $category->title;
        }
        return $categoryList;
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
}
