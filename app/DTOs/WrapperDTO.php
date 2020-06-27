<?php

namespace App\DTOs;

class WrapperDTO implements DTOInterface
{
    const HREF = 'href';

    /** @var string|null $href*/
    private $href;

    /**
     * WrapperDTO constructor.
     */
    private function __construct()
    {
        //
    }

    /**
     * @param array $data
     * @return DTOInterface
     */
    public static function fromArray(array $data): DTOInterface
    {
        $DTO = new static();
        $DTO->addHref($data[static::HREF] ?? null);

        return $DTO;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            static::HREF => $this->href,
        ];
    }

    /**
     * @param string|null $href
     */
    private function addHref(string $href = null): void
    {
        $this->href = $href;
    }
}
