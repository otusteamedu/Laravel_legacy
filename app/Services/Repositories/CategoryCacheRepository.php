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
    const CASH_KEY = 'CATEGORY';
    const CASH_TAG_NAME = 'CATEGORIES';
    const CASH_TTL = 60;

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
        $categories = \Cache::tags(self::CASH_TAG_NAME)->remember(self::getCacheKey('LIST'), Carbon::now()->addMinutes(self::CASH_TTL), function () use ($options) {
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
        $categories = \Cache::tags(self::CASH_TAG_NAME)->remember(self::getCacheKey('LIST'), Carbon::now()->addMinutes(self::CASH_TTL), function () use ($options) {
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
