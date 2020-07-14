<?php


namespace App\Advert\Domain\Model\Entities;


use Ramsey\Uuid\Uuid;

class Id
{

    private $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public static function next(): self
    {
        return new self(Uuid::uuid4()->toString());
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function isEqualTo()
    {

    }

}
