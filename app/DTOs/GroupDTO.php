<?php

namespace App\DTOs;

class GroupDTO implements DTOInterface
{
    /** @var int  */
    private $group;
    /** @var int  */
    private $course;
    /** @var string  */
    private $period;

    /**
     * GroupDTO constructor.
     * @param int $group
     * @param int $course
     * @param string $period
     */
    private function __construct(int $group, int $course, string $period)
    {
        $this->group = $group;
        $this->course = $course;
        $this->period = $period;
    }

    /**
     * @param array $data
     * @return DTOInterface
     */
    public static function fromArray(array $data): DTOInterface
    {
        return new static($data['group'], $data['course'], $data['year']);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'number' => $this->group,
            'course_id' => $this->course,
            'education_year_id' => $this->period,
        ];
    }
}
