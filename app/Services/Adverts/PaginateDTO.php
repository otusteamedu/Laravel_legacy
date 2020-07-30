<?php


namespace App\Services\Adverts;


class PaginateDTO
{

    public $items;
    public $links;

    public static function make($pages)
    {
        return new self($pages);
    }

    public function __construct($pages)
    {
        $this->items = $this->itemToObj($pages);
    }


    public function itemToObj($pages)
    {

        $arrayObjects =[];
        $this->links = $pages->links();

        foreach ($pages as $item)
        {
            $arrayObjects[] = (object)$item;
        }

        return $arrayObjects;
    }


}
