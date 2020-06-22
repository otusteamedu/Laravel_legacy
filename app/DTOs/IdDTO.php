<?php

namespace App\DTOs;

class IdDTO implements DTOInterface
{
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
        return new static($data['id']);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
        ];
    }
}
