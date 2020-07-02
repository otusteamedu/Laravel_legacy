<?php


namespace App\Services\Adverts;


use App\Models\Advert;
use App\Services\Adverts\Handler\StoreAdvertHandler;
use App\Services\Adverts\Repositories\AdvertCacheRepository;
use App\Services\Adverts\Repositories\AdvertRepositoryInterface;



class AdvertsService
{

    private $advertRepository;
    private $advertCacheRepository;
    private $advertHandler;

    public function __construct(
                    AdvertRepositoryInterface $advertRepository,
                    AdvertCacheRepository $advertCacheRepository,
                    StoreAdvertHandler $advertHandler
    )
    {
        $this->advertRepository = $advertRepository;
        $this->advertCacheRepository = $advertCacheRepository;
        $this->advertHandler = $advertHandler;
    }

    public function showItem($id)
    {
        return $this->advertRepository->find($id);
    }

    public function showAdvertList()
    {
        return $this->advertCacheRepository->cachingAdvertList();
    }

    public function showDivisionList()
    {
        return $this->advertRepository->divisionList();
    }

    public function page($qty)
    {
        return $this->advertCacheRepository->cachingPage($qty);
    }

    public function showTownList()
    {
        return $this->advertRepository->townList();
    }

    public function storeAdvert($data)
    {
        return $this->advertHandler->handle($data);
        //return $this->advertRepository->createFromArray($data);
    }

    public function updateAdvert(Advert $advert, array $data)
    {
        return $this->advertRepository->updateFromArray($advert, $data);
    }

    public function deleteAdvert(Advert $advert)
    {
        return $this->advertRepository->destroyFromObj($advert);
    }



}
