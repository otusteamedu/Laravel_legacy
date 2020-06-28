<?php

namespace App\Services\Subjects\Handlers;

use App\DTOs\WrapperDTO;
use App\Services\Helpers\TagWrapper;
use Illuminate\Support\Collection;

/**
 * Class WrapCoursesByHrefHandler
 * @package App\Services\Groups\Handlers
 *
 * Оборачивает эл-ты коллекция в тег <a></a>
 */
class WrapSubjectsByHrefHandler extends BaseHandler
{
    /**
     * @param Collection $subjects
     * @return Collection
     */
    public function handle(Collection $subjects): Collection
    {
        $groups = $subjects->pluck('name', 'id');
        /**
         * TODO изменить ссылку текстом на роут route('subjects.index')
         */
        $DTO = WrapperDTO::fromArray([WrapperDTO::HREF => 'subjects']);

        return TagWrapper::wrap($groups, TagWrapper::TAG_A, $DTO);
    }
}
