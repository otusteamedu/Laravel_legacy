<?php
/**
 * @copyright Copyright (c) Archvile <info@0x25.ru>
 * @link https://0x25.ru
 */

namespace App\Services\Products\Repositories;


use App\Models\Product;
use App\Services\Cache\CacheManagerInterface;
use App\Services\Cache\CacheTags;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class CachedProductsRepository implements CachedProductsRepositoryInterface
{

    /** @var CacheManagerInterface */
    protected $cacheManager;

    /** @var ProductsRepositoryInterface */
    protected $productsRepository;

    public function __construct(
        ProductsRepositoryInterface $productsRepository,
        CacheManagerInterface $cacheManager
    ) {
        $this->cacheManager = $cacheManager;
        $this->productsRepository = $productsRepository;
    }

    /**
     * @param  int  $id
     *
     * @return Product
     */
    public function getProductById(int $id) :Product
    {
        return Cache::tags(CacheTags::PRODUCT)
            ->rememberForever($this->cacheManager->publicCacheKey(route('product.show', ['product' => $id])), function () use ($id) {
                return $this->productsRepository->getProductById($id);
            });
    }

    /**
     * @param $event
     */
    public function warmProduct($event) :void
    {
        $this->getProductById($event->products->id);
    }
}