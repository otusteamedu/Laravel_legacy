<?php


namespace App\Services\Image;


use App\Services\Cache\KeyManager as CacheKeyManager;
use App\Services\Cache\Tag;
use App\Services\Cache\TTL;
use App\Services\Image\Repositories\ClientImageRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class ClientImageService
{
    private ClientImageRepository $repository;

    private CacheKeyManager $cacheKeyManager;

    /**
     * ClientImageService constructor.
     * @param ClientImageRepository $repository
     * @param CacheKeyManager $cacheKeyManager
     */
    public function __construct(
        ClientImageRepository $repository,
        CacheKeyManager $cacheKeyManager
    )
    {
        $this->repository = $repository;
        $this->cacheKeyManager = $cacheKeyManager;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getItem(int $id)
    {
        $key = $this->cacheKeyManager
            ->getImagesKey(['client', 'published', 'id_' . $id]);

        return Cache::tags(Tag::IMAGES_TAG)
            ->remember($key, TTL::IMAGES_TTL, function () use ($id) {
                return $this->repository->getResourceItem($id);
            });
    }

//    /**
//     * @param array $requestData
//     * @return mixed
//     */
//    public function getItems(array $requestData)
//    {
//        list(
//            'key' => $id,
//            'filter' => $filter,
//            'pagination' => $pagination) = $requestData;
//
//        $key = $this->cacheKeyManager
//            ->getImagesKey(
//                Arr::collapse([['client', 'published'],
//                    Arr::flatten($filter),
//                    Arr::flatten($pagination)])
//            );
//
//        return Cache::tags(Tag::IMAGES_TAG)
//            ->remember($key, TTL::IMAGES_TTL, function () use ($pagination) {
//            return $this->repository->getItems($pagination);
//        });
//    }

    /**
     * @param array $requestData
     * @return mixed
     */
    public function getWishListItems(array $requestData)
    {
        list(
            'key' => $ids,
            'filter' => $filter,
            'pagination' => $pagination) = $requestData;

        $paginateData = $this->repository->getWishListItems($ids, $pagination, $filter);

        $filtersKey = [];

        if ($filter !== null) {
            foreach($filter as $key => $field) {
                $filtersKey[$key] = ($key . '_' . implode('_', $field));
            }
        }

        $key = $this->cacheKeyManager
            ->getImagesKey(
                Arr::collapse([
                    ['client', 'published', 'wishList'],
                    Arr::flatten($ids),
                    Arr::flatten($pagination),
                    Arr::flatten($filtersKey)
            ]));

        return Cache::tags(Tag::IMAGES_TAG)
            ->remember($key, TTL::IMAGES_TTL, function () use ($paginateData) {
                return $paginateData;
            });
    }
}
