<?php

namespace Tests\Feature\Requests\Teacher;

use App\Http\Controllers\Teachers\Requests\StoreTeacherRequest;
use App\Http\Controllers\Teachers\Requests\UpdateTeacherRequest;
use App\Models\Role;
use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\Validator;
use Tests\Feature\Requests\RequestTrait;
use Tests\TestCase;

/**
 * Class UpdateTeacherRequestTest
 * @package Tests\Feature\Requests\Student
 * @group teacher
 */
class UpdateTeacherRequestTest extends TestCase
{
    use RefreshDatabase;
    use RequestTrait;

    /** @var UpdateTeacherRequest */
    private $rules;
    /** @var Validator */
    private $validator;

    public function setUp(): void
    {
        parent::setUp();

        $this->validator = app()->get('validator');
        $this->rules = (new UpdateTeacherRequest())->rules();
    }

    public function validationProvider(): array
    {
        $faker = Factory::create(Factory::DEFAULT_LOCALE);

        return [
            'request_should_fail_when_no_last_name_is_provided' => [
                'passed' => true,
                'data' => [
                    'name' => $faker->firstName,
                    'second_name' => $faker->firstName,
                    'subject_id' => [rand(),rand()],
                    'email' => $faker->email,
                ],
            ],
            'request_should_fail_when_last_name_is_not_sting' => [
                'passed' => false,
                'data' => [
                    'last_name' => 111,
                    'name' => $faker->firstName,
                    'second_name' => $faker->firstName,
                    'subject_id' => [rand(),rand()],
                    'email' => $faker->email,
                ],
            ],
            'request_should_fail_when_last_name_is_to_long' => [
                'passed' => false,
                'data' => [
                    'last_name' => $faker->paragraph(30),
                    'name' => $faker->firstName,
                    'second_name' => $faker->firstName,
                    'subject_id' => [rand(),rand()],
                    'email' => $faker->email,
                ],
            ],

            'request_should_fail_when_no_name_is_provided' => [
                'passed' => true,
                'data' => [
                    'last_name' => $faker->lastName,
                    'second_name' => $faker->firstName,
                    'subject_id' => [rand(),rand()],
                    'email' => $faker->email,
                ],
            ],
            'request_should_fail_when_name_is_not_sting' => [
                'passed' => false,
                'data' => [
                    'last_name' => $faker->lastName,
                    'name' => 111,
                    'second_name' => $faker->firstName,
                    'subject_id' => [rand(),rand()],
                    'email' => $faker->email,
                ],
            ],
            'request_should_fail_when_name_is_to_long' => [
                'passed' => false,
                'data' => [
                    'last_name' => $faker->lastName,
                    'name' => $faker->paragraph(30),
                    'second_name' => $faker->firstName,
                    'subject_id' => [rand(),rand()],
                    'email' => $faker->email,
                ],
            ],

            'request_should_fail_when_no_second_name_is_provided' => [
                'passed' => true,
                'data' => [
                    'last_name' => $faker->lastName,
                    'name' => $faker->firstName,
                    'subject_id' => [rand(),rand()],
                    'email' => $faker->email,
                ],
            ],
            'request_should_fail_when_second_name_is_not_sting' => [
                'passed' => false,
                'data' => [
                    'last_name' => $faker->lastName,
                    'name' => $faker->firstName,
                    'second_name' => 111,
                    'subject_id' => [rand(),rand()],
                    'email' => $faker->email,
                ],
            ],
            'request_should_fail_when_second_name_is_to_long' => [
                'passed' => false,
                'data' => [
                    'last_name' => $faker->lastName,
                    'name' => $faker->firstName,
                    'second_name' => $faker->paragraph(30),
                    'subject_id' => [rand(),rand()],
                    'email' => $faker->email,
                ],
            ],

            'request_should_fail_when_no_subject_id_is_provided' => [
                'passed' => true,
                'data' => [
                    'last_name' => $faker->lastName,
                    'name' => $faker->firstName,
                    'second_name' => $faker->firstName,
                    'email' => $faker->email,
                ],
            ],
            'request_should_fail_when_subject_id_is_not_an_array' => [
                'passed' => false,
                'data' => [
                    'last_name' => $faker->lastName,
                    'name' => $faker->firstName,
                    'second_name' => $faker->firstName,
                    'subject_id' => 111,
                    'email' => $faker->email,
                ],
            ],
            'request_should_fail_when_subject_id_is_empty' => [
                'passed' => false,
                'data' => [
                    'last_name' => $faker->lastName,
                    'name' => $faker->firstName,
                    'second_name' => $faker->firstName,
                    'subject_id' => [],
                    'email' => $faker->email,
                ],
            ],
            'request_should_fail_when_subject_id_has_not_integer' => [
                'passed' => false,
                'data' => [
                    'last_name' => $faker->lastName,
                    'name' => $faker->firstName,
                    'second_name' => $faker->firstName,
                    'subject_id' => ['test'],
                    'email' => $faker->email,
                ],
            ],

            'request_should_fail_when_no_email_is_provided' => [
                'passed' => true,
                'data' => [
                    'last_name' => $faker->lastName,
                    'name' => $faker->firstName,
                    'second_name' => $faker->firstName,
                    'subject_id' => [rand(),rand()],
                ],
            ],
            'request_should_pass_when_email_is_not_email_type' => [
                'passed' => false,
                'data' => [
                    'last_name' => $faker->lastName,
                    'name' => $faker->firstName,
                    'second_name' => $faker->firstName,
                    'subject_id' => [rand(),rand()],
                    'email' => 'email',
                ],
            ],
            'request_should_pass_when_email_is_to_long' => [
                'passed' => false,
                'data' => [
                    'last_name' => $faker->lastName,
                    'name' => $faker->firstName,
                    'second_name' => $faker->firstName,
                    'subject_id' => [rand(),rand()],
                    'email' => $faker->paragraph(30) . '@email.email',
                ],
            ],

            'request_should_pass_when_data_is_provided' => [
                'passed' => true,
                'data' => [
                    'last_name' => $faker->lastName,
                    'name' => $faker->firstName,
                    'second_name' => $faker->firstName,
                    'subject_id' => [rand(),rand()],
                    'email' => $faker->email,
                ],
            ],
        ];
    }

    public function testUniqueEmail(): void
    {
        $this->seed(\RoleSeeder::class);
        $faker = Factory::create(Factory::DEFAULT_LOCALE);
        $email = 'email@email.email';
        $teacher = $user = factory(User::class)->create([
            'role_id' => Role::ADMIN,
            'email' => $email,
        ]);

        /**
         * Почта совпадает с почтой другого пользователя
         */
        $someEmail = 'some_email@email.email';
        factory(User::class)->create([
            'role_id' => Role::TEACHER,
            'email' => $someEmail,
        ]);
        $this->actingAs($user)->put(route('teachers.update', $teacher), [
            'last_name' => $faker->lastName,
            'name' => $faker->firstName,
            'second_name' => $faker->firstName,
            'subject_id' => [rand(),rand()],
            'email' => $someEmail,
        ])->assertSessionHasErrors(['email']);

        /**
         * Оставляем почту без имзенений у обновляемого пользователя
         */
        $this->actingAs($user)->put(route('teachers.update', $teacher), [
            'last_name' => $faker->lastName,
            'name' => $faker->firstName,
            'second_name' => $faker->firstName,
            'subject_id' => [rand(),rand()],
            'email' => $email,
        ])->assertSessionHasNoErrors();
    }
}
