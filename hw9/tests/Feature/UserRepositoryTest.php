<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use App\Models\User;
use Tests\Generators\UserGenerator;
use Illuminate\Support\Facades\Auth;


class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /*
        public function setUp(): void
        {
            parent::setUp();
            $this->artisan('db:seed');
        }
    */
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateNewUser()
    {
        $data['name'] = 'test_user';
        $data['email'] = 'test_user@test.ru';
        $user = UserGenerator::createUserAdminWithRole($data);
        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
        ]);
    }

    /**
     * Check don't create user with the same email
     * @expectException PDOException
     */
    public function testCreateUserFailsDublicate()
    {
        $data['name'] = 'test_user2';
        $data['email'] = 'test_user2@test.ru';
        //первого добавляем
        $users_count_before = User::all()->count();
        $user = UserGenerator::createUserAdminWithRole($data);
        $this->assertEquals($users_count_before + 1, User::all()->count());

        $this->expectExceptionCode(23000);
        $this->expectExceptionMessageRegExp('/Duplicate entry/');

        $user = UserGenerator::createUserAdminWithRole($data);
    }

    /**
     * Check don't create user with the empty data
     * @expectException QueryException
     */

    public function testCreateUserFailsEmpty()
    {
        $users_count_before = User::all()->count();
        $this->expectExceptionMessageRegExp('/ cannot be null/');
        $this->expectException(QueryException::class);
        $this->expectExceptionCode(23000);

        $user = UserGenerator::createUserAdminWithRole();
        //$user = factory(User::class)->create($data);
    }

    public function testDeleteUser()
    {
        $data['name'] = 'test_user2';
        $res = User::where('name', $data['name'])->delete();
        $this->assertDatabaseMissing('users', [
            'name' => $data['name'],
        ]);

        $data['name'] = 'test_user';
        $res = User::where('name', $data['name'])->delete();
        $this->assertDatabaseMissing('users', [
            'name' => $data['name'],
        ]);
    }
}
