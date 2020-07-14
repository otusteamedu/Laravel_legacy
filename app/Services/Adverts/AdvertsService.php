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
        $item = $this->advertRepository->find($id);
        return ItemDto::make($item);
    }

    public function showAdvertList()
    {
        return $this->advertCacheRepository->cachingAdvertList();
    }

    public function showDivisionList()
    {
        $division =$this->advertRepository->divisionList();
        return ItemsDto::make($division);
    }

    public function showTownList()
    {
        $town = $this->advertRepository->townList();
        return ItemsDto::make($town);
    }

    public function page($qty)
    {
//        return $this->advertCacheRepository->cachingPage($qty);
        $pages = $this->advertRepository->paginateList($qty);
        return PaginateDto::make($pages);
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
