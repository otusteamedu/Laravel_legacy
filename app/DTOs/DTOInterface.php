<?php

namespace App\DTOs;

interface DTOInterface
{
    /**
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data): self;

    /**
     * @return array
     */
    public function toArray(): array;
}
