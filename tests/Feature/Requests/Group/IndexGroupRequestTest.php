<?php

namespace Tests\Feature\Requests\Group;

use App\Http\Controllers\Groups\Requests\IndexGroupRequest;
use Faker\Factory;
use Illuminate\Validation\Validator;
use Tests\Feature\Requests\RequestTrait;
use Tests\TestCase;

/**
 * Class IndexGroupRequestTest
 * @package Tests\Feature\Requests\Group
 * @group group
 */
class IndexGroupRequestTest extends TestCase
{
    use RequestTrait;

    /** @var IndexGroupRequest */
    private $rules;

    /** @var Validator */
    private $validator;

    public function setUp(): void
    {
        parent::setUp();

        $this->validator = app()->get('validator');

        $this->rules = (new IndexGroupRequest())->rules();
    }

    public function validationProvider(): array
    {
        $faker = Factory::create(Factory::DEFAULT_LOCALE);

        return [
            'request_should_fail_when_group_is_not_integer' => [
                'passed' => false,
                'data' => [
                    'group' => 'test',
                ],
            ],
            'request_should_fail_when_group_is_0' => [
                'passed' => false,
                'data' => [
                    'group' => 0,
                ],
            ],
            'request_should_fail_when_course_is_not_integer' => [
                'passed' => false,
                'data' => [
                    'course' => 'test',
                ],
            ],
            'request_should_fail_when_course_is_0' => [
                'passed' => false,
                'data' => [
                    'course' => 0,
                ],
            ],
            'request_should_fail_when_teacher_is_not_string' => [
                'passed' => false,
                'data' => [
                    'teacher' => 1,
                ],
            ],
            'request_should_fail_when_teacher_is_more_than_255' => [
                'passed' => false,
                'data' => [
                    'teacher' => $faker->paragraph(10),
                ],
            ],
            'request_should_pass_when_data_is_provided' => [
                'passed' => true,
                'data' => [
                    'group' => rand(),
                    'course' => rand(),
                    'teacher' => $faker->lastName,
                ],
            ],
            'request_should_pass_when_data_is_nullable' => [
                'passed' => true,
                'data' => [
                    'group' => null,
                    'course' => null,
                    'teacher' => null,
                ],
            ],
            'request_should_pass_when_no_data_is_provided' => [
                'passed' => true,
                'data' => [],
            ],
        ];
    }
}
