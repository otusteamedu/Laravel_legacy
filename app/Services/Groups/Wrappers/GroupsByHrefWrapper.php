<?php

namespace App\Services\Groups\Wrappers;

use App\DTOs\WrapperDTO;
use App\Services\Helpers\TagWrapper;
use Illuminate\Support\Collection;

/**
 * Class WrapCoursesByHrefHandler
 * @package App\Services\Groups\Handlers
 *
 * Оборачивает эл-ты коллекция в тег <a></a>
 */
class GroupsByHrefWrapper
{
    /**
     * @param Collection $groups
     * @return Collection
     */
    public function wrap(Collection $groups): Collection
    {
        $groups = $groups->pluck('number', 'id');
        $DTO = WrapperDTO::fromArray([WrapperDTO::HREF => route('groups.index')]);

        return TagWrapper::wrap($groups, TagWrapper::TAG_A, $DTO);
    }
}
