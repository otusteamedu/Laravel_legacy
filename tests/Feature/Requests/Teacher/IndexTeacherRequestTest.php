<?php

namespace Tests\Feature\Requests\Teacher;

use App\Http\Controllers\Students\Requests\IndexStudentRequest;
use App\Http\Controllers\Teachers\Requests\IndexTeacherRequest;
use Faker\Factory;
use Illuminate\Validation\Validator;
use Tests\Feature\Requests\RequestTrait;
use Tests\TestCase;

/**
 * Class IndexTeacherRequestTest
 * @package Tests\Feature\Requests\Student
 * @group teacher
 */
class IndexTeacherRequestTest extends TestCase
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

        $this->rules = (new IndexTeacherRequest())->rules();
    }

    public function validationProvider(): array
    {
        $faker = Factory::create(Factory::DEFAULT_LOCALE);

        return [
            'request_should_fail_when_last_name_is_not_string' => [
                'passed' => false,
                'data' => [
                    'last_name' => 111,
                    'email' => $faker->email,
                    'subject_id' => rand(),
                ],
            ],
            'request_should_fail_when_last_name_is_to_long' => [
                'passed' => false,
                'data' => [
                    'last_name' => $faker->paragraph(10),
                    'email' => $faker->email,
                    'subject_id' => rand(),
                ],
            ],
            'request_should_fail_when_email_is_not_string' => [
                'passed' => false,
                'data' => [
                    'last_name' => $faker->lastName,
                    'email' => 111,
                    'subject_id' => rand(),
                ],
            ],
            'request_should_fail_when_email_is_to_long' => [
                'passed' => false,
                'data' => [
                    'last_name' => $faker->lastName,
                    'email' => $faker->paragraph(10),
                    'subject_id' => rand(),
                ],
            ],
            'request_should_fail_when_subject_id_is_not_integer' => [
                'passed' => false,
                'data' => [
                    'last_name' => $faker->lastName,
                    'email' => $faker->email,
                    'subject_id' => 'test',
                ],
            ],
            'request_should_fail_when_subject_id_id_0' => [
                'passed' => false,
                'data' => [
                    'last_name' => $faker->lastName,
                    'email' => $faker->email,
                    'subject_id' => 0,
                ],
            ],

            'request_should_pass_when_data_is_provided' => [
                'passed' => true,
                'data' => [
                    'last_name' => $faker->lastName,
                    'email' => $faker->email,
                    'subject_id' => rand(),
                ],
            ],
            'request_should_pass_when_data_is_nullable' => [
                'passed' => true,
                'data' => [
                    'last_name' => null,
                    'email' => null,
                    'subject_id' => null,
                ],
            ],
            'request_should_pass_when_no_data_is_provided' => [
                'passed' => true,
                'data' => [],
            ],
        ];
    }
}
