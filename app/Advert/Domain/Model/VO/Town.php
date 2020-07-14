<?php


namespace App\Advert\Domain\Model\Vo;


class Town
{

    private $name;
    private $state;

    public function __construct($name, $state)
    {
        $this->name = $name;
        $this->state = $state;
    }

    public function getName(): string
    {
        return $this->name.'-'.$this->state;
    }

}
