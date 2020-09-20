<?php


namespace App\Services\Adverts;

use App\Http\Controllers\CookieController;
use App\Models\Advert;
use App\Models\User;
use App\Services\Adverts\Cache\AdvertCacheService;
use App\Services\Adverts\Handler\StoreAdvertHandler;
use App\Services\Adverts\Repositories\AdvertRepositoryInterface;
use App\Services\Repositories\RepositoryInterface;


class AdvertsService
{

    private $advertRepository;
    private $advertCacheService;
    private $advertHandler;
    private $cookieController;
    private $repository;
    private $searchAdvertsService;

    public function __construct(
        AdvertRepositoryInterface $advertRepository,
        AdvertCacheService $advertCacheService,
        StoreAdvertHandler $advertHandler,
        CookieController $cookieController,
        //RepositoryInterface $repository,
        SearchAdvertsService $searchAdvertsService
    ) {
        $this->advertRepository = $advertRepository;
        $this->advertCacheService = $advertCacheService;
        $this->advertHandler = $advertHandler;
        $this->cookieController = $cookieController;
        //$this->repository = $repository;
        //$this->repository->setModel('Advert');
        $this->searchAdvertsService = $searchAdvertsService;
    }

    public function showItem($id)
    {
        $item = $this->advertRepository->find($id);
        return $item;
    }

    public function showAdvertList()
    {
        return $this->advertCacheService->cachingAdvertList();
    }

    public function pageApi(int $limit, int $offset)
    {
        return $this->advertCacheService->cachingPageApi($limit, $offset);
    }

    public function page($qty)
    {
        $pages = $this->advertCacheService->cachingPage($qty);
        return $pages;
    }

    public function storeAdvert($data)
    {
         return $this->advertHandler->handle($data);
    }

    public function updateAdvert(Advert $advert, array $data)
    {
        return $this->advertRepository->updateFromArray($advert, $data);
    }

    public function deleteAdvert(Advert $advert)
    {
        $advert = $this->advertRepository->destroyFromObj($advert);
        $this->advertCacheService->forgetAdvertCachedPages(); //TODO переделать через хендлер

        return $advert;
    }

    public function getUserAdverts($userId)
    {
        return $this->advertRepository->filteredByUserAdverts($userId);
    }

    public function getUserInfo($userId) //TODO убрать в  UserService
    {
        return User::find($userId);

    }



}
