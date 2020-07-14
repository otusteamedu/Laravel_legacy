<?php


namespace App\Services\Adverts;


class ItemsDto
{

    public $items;

    public static function make($array)
    {
        return new self($array);
    }

    public function __construct($array)
    {
        $this->items = $this->itemToObj($array);
    }


    public function itemToObj($array)
    {
        $arrayObjects =[];

        foreach ($array as $item)
        {
            $arrayObjects[] = (object)$item;
        }

        return $arrayObjects;
    }

}

