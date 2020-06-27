<?php

namespace App\Services\Groups\Handlers;

use App\DTOs\WrapperDTO;
use App\Services\Helpers\TagWrapper;
use Illuminate\Support\Collection;

/**
 * Class WrapCoursesByHrefHandler
 * @package App\Services\Groups\Handlers
 *
 * Оборачивает эл-ты коллекция в тег <a></a>
 */
class WrapGroupsByHrefHandler extends BaseHandler
{
    /**
     * @param Collection $courses
     * @return Collection
     */
    public function handle(Collection $groups): Collection
    {
        $groups = $groups->pluck('number', 'id');
        $DTO = WrapperDTO::fromArray([WrapperDTO::HREF => route('groups.index')]);

        return TagWrapper::wrap($groups, TagWrapper::TAG_A, $DTO);
    }
}
