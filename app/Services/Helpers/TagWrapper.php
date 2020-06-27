<?php

namespace App\Services\Helpers;

use App\DTOs\WrapperDTO;
use Illuminate\Support\Collection;

/**
 * Class TagWrapper
 * @package App\Services\Helpers
 *
 * Оборачивает элементы колллекции вида {id => $item} в теги
 */
class TagWrapper
{
    /** @var string  */
    const TAG_A = 'a';

    /**
     * @param Collection $collection
     * @param WrapperDTO $DTO
     * @return Collection
     */
    protected static function tagA(Collection $collection, WrapperDTO $DTO): Collection
    {
        $href = $DTO->toArray()[WrapperDTO::HREF];

        return $collection->map(function ($item, int $key) use ($href) {
            return '<a href="' . $href . '/' . $key . '">' . $item . '</a>';
        });
    }

    /**
     * @param Collection $collection
     * @param string $tag
     * @param WrapperDTO $DTO
     * @return Collection
     */
    public static function wrap(Collection $collection, string $tag, WrapperDTO $DTO): Collection
    {
        if (!$tag) {
            $tag = static::TAG_A;
        }

        switch ($tag) {
            case static::TAG_A:
                return static::tagA($collection, $DTO);
            default:
                return $collection;
        }
    }
}
