<?php

namespace App\DTOs;

use App\Services\Helpers\Settings;
use Exception;

/**
 * Class PostDTO
 * @package App\DTOs
 */
class PostFilterDTO implements DTOInterface
{
    const GROUPS = 'groups';
    const TITLE = 'title';
    const PUBLISHED  = 'published';
    const LIMIT  = 'limit';

    /**
     * @var string|null
     */
    private $title;
    /**
     * @var bool|null
     */
    private $published;
    /**
     * @var array
     */
    private $groups;
    /**
     * @var int
     */
    private $limit;

    /**
     * PostFilterDTO constructor.
     * @param string|null $title
     * @param bool|null $published
     * @param array $groups
     * @param int $limit
     * @throws Exception
     */
    private function __construct(?string $title, ?bool $published, array $groups, int $limit)
    {
        $this->title = $title;
        $this->published = $published;
        $this->groups = $this->prepareGroups($groups);
        $this->limit = $limit;
    }

    /**
     * @param array $groups
     * @return array
     */
    private function prepareGroups(array $groups): array
    {
        $result = [];
        foreach ($groups as $group) {
            $group = (int)$group;
            if (!is_int($group) || $group === 0) {
                throw new Exception($group . ' must be integer.');
            }

            $result[] = $group;
        }

        return $result;
    }

    /**
     * @param array $data
     * @return DTOInterface
     * @throws Exception
     */
    public static function fromArray(array $data): DTOInterface
    {
        return new static(
            $data[static::TITLE] ?? null,
            $data[static::PUBLISHED] ?? null,
            $data[static::GROUPS] ?? [],
            $data[static::LIMIT] ?? Settings::PER_PAGE
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            static::TITLE => $this->title,
            static::PUBLISHED => $this->published,
            static::GROUPS => $this->groups,
            static::LIMIT => $this->limit,
        ];
    }
}
