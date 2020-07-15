<?php

namespace Tests\Feature\Requests\Group;

use App\Http\Controllers\Groups\Requests\StoreGroupRequest;
use Illuminate\Validation\Validator;
use Tests\Feature\Requests\RequestTrait;
use Tests\TestCase;

/**
 * Class StoreGroupRequestTest
 * @package Tests\Feature\Requests\Group
 * @group group
 */
class StoreGroupRequestTest extends TestCase
{
    use RequestTrait;

    /** @var StoreGroupRequest */
    private $rules;

    /** @var Validator */
    private $validator;

    public function setUp(): void
    {
        parent::setUp();

        $this->validator = app()->get('validator');

        $this->rules = (new StoreGroupRequest())->rules();
    }

    public function validationProvider(): array
    {
        return [
            'request_should_fail_when_no_number_is_provided' => [
                'passed' => false,
                'data' => [
                    'course_id' => rand(),
                    'education_year_id' => rand(),
                ],
            ],
            'request_should_fail_when_number_is_0' => [
                'passed' => false,
                'data' => [
                    'number' => 0,
                    'course_id' => rand(),
                    'education_year_id' => rand(),
                ],
            ],
            'request_should_fail_when_number_is_to_max' => [
                'passed' => false,
                'data' => [
                    'number' => 1234567890,
                    'course_id' => rand(),
                    'education_year_id' => rand(),
                ],
            ],
            'request_should_fail_when_no_course_id_is_provided' => [
                'passed' => false,
                'data' => [
                    'number' => rand(1, 99999),
                    'education_year_id' => rand(),
                ],
            ],
            'request_should_fail_when_course_id_is_0' => [
                'passed' => false,
                'data' => [
                    'number' => rand(1, 99999),
                    'course_id' => 0,
                    'education_year_id' => rand(),
                ],
            ],
            'request_should_fail_when_no_education_year_id_is_provided' => [
                'passed' => false,
                'data' => [
                    'number' => rand(1, 99999),
                    'course_id' => rand(),
                ],
            ],
            'request_should_fail_when_education_year_id_is_0' => [
                'passed' => false,
                'data' => [
                    'number' => rand(1, 99999),
                    'course_id' => rand(),
                    'education_year_id' => 0,
                ],
            ],
            'request_should_pass_when_data_is_provided' => [
                'passed' => true,
                'data' => [
                    'number' => rand(1, 99999),
                    'course_id' => rand(),
                    'education_year_id' => rand(),
                ],
            ],
        ];
    }
}
