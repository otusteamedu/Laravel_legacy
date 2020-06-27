<?php

namespace App\DTOs;

class GroupDTO implements DTOInterface
{
    const NUMBER = 'number';
    const COURSE_ID = 'course_id';
    const EDUCATION_YEAR_ID = 'education_year_id';

    /** @var int  */
    private $number;
    /** @var int  */
    private $course_id;
    /** @var int  */
    private $education_year_id;

    /**
     * GroupDTO constructor.
     * @param int $number
     * @param int $courseId
     * @param int $educationYearId
     */
    private function __construct(int $number, int $courseId, int $educationYearId)
    {
        $this->number = $number;
        $this->course_id = $courseId;
        $this->education_year_id = $educationYearId;
    }

    /**
     * @param array $data
     * @return DTOInterface
     */
    public static function fromArray(array $data): DTOInterface
    {
        return new static($data[static::NUMBER], $data[static::COURSE_ID], $data[static::EDUCATION_YEAR_ID]);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            static::NUMBER => $this->number,
            static::COURSE_ID => $this->course_id,
            static::EDUCATION_YEAR_ID => $this->education_year_id,
        ];
    }
}
