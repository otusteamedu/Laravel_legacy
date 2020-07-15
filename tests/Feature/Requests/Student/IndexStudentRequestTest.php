<?php

namespace Tests\Feature\Requests\Student;

use App\Http\Controllers\Students\Requests\IndexStudentRequest;
use Faker\Factory;
use Illuminate\Validation\Validator;
use Tests\Feature\Requests\RequestTrait;
use Tests\TestCase;

/**
 * Class IndexStudentRequestTest
 * @package Tests\Feature\Requests\Student
 * @group student
 */
class IndexStudentRequestTest extends TestCase
{
    use RequestTrait;

    /** @var IndexStudentRequest */
    private $rules;

    /** @var Validator */
    private $validator;

    public function setUp(): void
    {
        parent::setUp();

        $this->validator = app()->get('validator');

        $this->rules = (new IndexStudentRequest())->rules();
    }

    public function validationProvider(): array
    {
        $faker = Factory::create(Factory::DEFAULT_LOCALE);

        return [
            'request_should_fail_when_group_is_not_integer' => [
                'passed' => false,
                'data' => [
                    'group' => 'test',
                    'course' => rand(),
                    'last_name' => $faker->lastName,
                    'id_number' => rand(),
                ],
            ],
            'request_should_fail_when_group_is_0' => [
                'passed' => false,
                'data' => [
                    'group' => 0,
                    'course' => rand(),
                    'last_name' => $faker->lastName,
                    'id_number' => rand(),
                ],
            ],
            'request_should_fail_when_course_is_not_integer' => [
                'passed' => false,
                'data' => [
                    'group' => rand(),
                    'course' => 'test',
                    'last_name' => $faker->lastName,
                    'id_number' => rand(),
                ],
            ],
            'request_should_fail_when_course_is_0' => [
                'passed' => false,
                'data' => [
                    'group' => rand(),
                    'course' => 0,
                    'last_name' => $faker->lastName,
                    'id_number' => rand(),
                ],
            ],
            'request_should_fail_when_last_name_is_not_string' => [
                'passed' => false,
                'data' => [
                    'group' => rand(),
                    'course' => rand(),
                    'last_name' => 111,
                    'id_number' => rand(),
                ],
            ],
            'request_should_fail_when_teacher_is_more_than_255' => [
                'passed' => false,
                'data' => [
                    'group' => rand(),
                    'course' => rand(),
                    'last_name' => $faker->paragraph(30),
                    'id_number' => rand(),
                ],
            ],
            'request_should_fail_when_id_number_is_not_integer' => [
                'passed' => false,
                'data' => [
                    'group' => rand(),
                    'course' => rand(),
                    'last_name' => $faker->lastName,
                    'id_number' => 'test',
                ],
            ],
            'request_should_fail_when_id_number_is_0' => [
                'passed' => true,
                'data' => [
                    'group' => rand(),
                    'course' => rand(),
                    'last_name' => $faker->lastName,
                    'id_number' => 0,
                ],
            ],
            'request_should_pass_when_data_is_provided' => [
                'passed' => true,
                'data' => [
                    'group' => rand(),
                    'course' => rand(),
                    'last_name' => $faker->lastName,
                    'id_number' => rand(),
                ],
            ],
            'request_should_pass_when_data_is_nullable' => [
                'passed' => true,
                'data' => [
                    'group' => null,
                    'course' => null,
                    'last_name' => null,
                    'id_number' => null,
                ],
            ],
            'request_should_pass_when_no_data_is_provided' => [
                'passed' => true,
                'data' => [],
            ],
        ];
    }
}
