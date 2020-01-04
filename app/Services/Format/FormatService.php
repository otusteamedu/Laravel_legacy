<?php


namespace App\Services\Format;


use App\Services\Format\Handlers\GetAllFormatHandler;
use Illuminate\Database\Eloquent\Collection;

class FormatService
{
    /**
     * @var GetAllFormatHandler
     */
    private $getAllHandler;

    /**
     * FormatService constructor.
     * @param GetAllFormatHandler $getAllFormatHandler
     */
    public function __construct(GetAllFormatHandler $getAllFormatHandler)
    {
        $this->getAllHandler = $getAllFormatHandler;
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection {
        return $this->getAllHandler->handle();
    }
}
