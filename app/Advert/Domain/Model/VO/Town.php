<?php


namespace App\Advert\Domain\Model\VO;


class Town
{

    private $name;
    private $state;

    public function __construct(string $name, string $state)
    {
        $this->name = $name;
        $this->state = $state;
    }

    public function getName(): array
    {
        return [$this->name, $this->state];
    }

}
