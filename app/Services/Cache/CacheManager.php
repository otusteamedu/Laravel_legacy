<?php


namespace App\Services\Cache;


use App\Services\Category\Handlers\CacheWarmUpHandler as CategoryWarmUpHandler;

class CacheManager
{
    private CategoryWarmUpHandler $categoryWarmUpHandler;

    public function __construct(
        CategoryWarmUpHandler $categoryWarmUpHandler
    )
    {
        $this->categoryWarmUpHandler = $categoryWarmUpHandler;
    }

    public function set(string $tag, ?int $ttl = null)
    {
        switch ($tag) {
            case 'category':
                return $this->categoryWarmUpHandler->handle($ttl);
                break;
//            case 'etc':
                // future code
//                break:
            default:
                return false;
        }
    }

}
