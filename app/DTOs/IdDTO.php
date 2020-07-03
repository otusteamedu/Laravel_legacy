<?php

namespace App\DTOs;

class IdDTO implements DTOInterface
{
    const ID = 'id';

    /** @var int  */
    private $id;

    /**
     * IdDTO constructor.
     * @param int $id
     */
    private function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @param array $data
     * @return DTOInterface
     */
    public static function fromArray(array $data): DTOInterface
    {
        return new static($data[static::ID]);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            static::ID => $this->id,
        ];
    }
}
