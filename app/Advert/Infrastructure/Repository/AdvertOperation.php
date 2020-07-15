<?php


namespace App\Advert\Domain\Service;


interface AdvertOperation
{

    public function publishAdvert();
    public function viewAdvert();
    public function editAdvert();
    public function deleteAdvert();
    public function archiveAdvert();
    public function addMessageToAdvert();
    public function editMessageInAdvert();
    public function deleteMessageFromAdvert();

}
