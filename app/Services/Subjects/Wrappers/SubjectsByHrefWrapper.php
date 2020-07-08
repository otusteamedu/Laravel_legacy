<?php

namespace App\Services\Subjects\Wrappers;

use App\DTOs\WrapperDTO;
use App\Services\Helpers\TagWrapper;
use Illuminate\Support\Collection;

/**
 * Class WrapCoursesByHrefHandler
 * @package App\Services\Groups\Handlers
 *
 * Оборачивает эл-ты коллекция в тег <a></a>
 */
class SubjectsByHrefWrapper
{
    /**
     * @param Collection $subjects
     * @return Collection
     */
    public function wrap(Collection $subjects): Collection
    {
        $groups = $subjects->pluck('name', 'id');
        /**
         * TODO изменить ссылку текстом на роут route('subjects.index')
         */
        $DTO = WrapperDTO::fromArray([WrapperDTO::HREF => '/dashboard/subjects']);

        return TagWrapper::wrap($groups, TagWrapper::TAG_A, $DTO);
    }
}
