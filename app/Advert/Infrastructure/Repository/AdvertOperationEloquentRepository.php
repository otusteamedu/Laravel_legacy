<?php


namespace App\Advert\Infrastructure\Repository;


use App\Advert\Domain\Service\AdvertOperationService;
use App\Models\Advert;
use App\Services\Adverts\Repositories\AdvertRepositoryInterface;

class AdvertOperationEloquentRepository implements AdvertOperationService
{


    public function publishAdvert()
    {
        // TODO: Implement publishAdvert() method.
    }

    public function viewAdvert()
    {
        // TODO: Implement viewAdvert() method.
    }

    public function editAdvert()
    {
        // TODO: Implement editAdvert() method.
    }

    public function deleteAdvert()
    {
        // TODO: Implement deleteAdvert() method.
    }

    public function archiveAdvert()
    {
        // TODO: Implement archiveAdvert() method.
    }

    public function addMessageToAdvert()
    {
        // TODO: Implement addMessageToAdvert() method.
    }

    public function editMessageInAdvert()
    {
        // TODO: Implement editMessageInAdvert() method.
    }

    public function deleteMessageFromAdvert()
    {
        // TODO: Implement deleteMessageFromAdvert() method.
    }
}


//Все что связано с модулями (swiftmailer, eloquent,  ) можно реализовать через срвисы/репозитории,
// тем самым можно отвязаться от конкретных модулей и базы данных
//
