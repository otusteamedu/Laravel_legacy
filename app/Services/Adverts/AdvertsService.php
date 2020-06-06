<?php


namespace App\Services\Adverts;


use App\Models\Advert;
use App\Services\Adverts\Repositories\AdvertRepositoryInterface;


class AdvertsService
{

    private $advertRepository;

    public function __construct(AdvertRepositoryInterface $advertRepository)
    {
        $this->advertRepository = $advertRepository;
    }

    public function showItem($id)
    {
        return $this->advertRepository->find($id);
    }

    public function showAdvertList()
    {
        return $this->advertRepository->list();
    }

    public function showDivisionList()
    {
        return $this->advertRepository->divisionList();
    }

    public function page($qty)
    {
        return $this->advertRepository->paginateList($qty);
    }

    public function showTownList()
    {
        return $this->advertRepository->townList();
    }

    public function storeAdvert($data)
    {
        return $this->advertRepository->createFromArray($data);
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
