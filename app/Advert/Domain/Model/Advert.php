<?php


namespace App\Advert\Domain\Model;


use App\Advert\Domain\Model\Entities\Id;
use App\Advert\Domain\Model\Entities\Owner;
use App\Advert\Domain\Model\Vo\Division;
use App\Advert\Domain\Model\Vo\Town;
use App\Advert\Domain\Model\Vo\Img;

class Advert
{
    /**
     * @var Id
     */
    private $id;
    /**
     * @var User
     */
    private $owner;
    /**
     * @var Town
     */
    private $town;
    /**
     * @var Division
     */
    private $division;
    /**
     * @var Title
     */
    private $title;
    /**
     * @var Price
     */
    private $price;
    /**
     * @var Img
     */
    private $img;
    /**
     * @var Content
     */
    private $content;
    /**
     * @var Dates
     */
    private $date;

    public function __construct
        (
            Id $id, Owner $owner, Town $town, Division $division,
            $title, $price, Img $img, $content, $date
        )
    {

        $this->id = $id;
        $this->owner = $owner;
        $this->town = $town;
        $this->division = $division;
        $this->title = $title;
        $this->price = $price;
        $this->img = $img;
        $this->content = $content;
        $this->date = $date;
    }

    public function publishAdvert() {}
    public function viewAdvert() {}
    public function editAdvert() {}
    public function deleteAdvert() {}
    public function archiveAdvert() {}
    public function addMessageToAdvert() {}
    public function editMessageInAdvert() {}
    public function deleteMessageFromAdvert() {}
}
