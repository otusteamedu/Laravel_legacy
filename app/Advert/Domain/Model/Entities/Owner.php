<?php


namespace App\Advert\Domain\Model\Entities;


class Owner
{


    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $phone;
    /**
     * @var string
     */
    private $address;
    /**
     * @var string
     */
    private $zipCode;

    public function __construct(string $name, string $phone, string $address, string $zipCode)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->address = $address;
        $this->zipCode = $zipCode;
    }

    public function getFullData(): array
    {
        return ['Name: '=>$this->name,'tel:'=>$this->phone,'Adr:'=>$this->address];
    }
}
