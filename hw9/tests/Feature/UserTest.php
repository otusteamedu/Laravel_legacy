<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use App\Models\User;


class UserTest extends TestCase
{
    //use RefreshDatabase;

    public function testUserRoute()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)
            ->call('GET', route('admin.users.index'));
        $response->assertStatus(200);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateUser()
    {

        $data['name'] = 'test_user';
        $data['email'] = 'test_user@test.ru';
        $user = factory(User::class)->create($data);
        // $this->assertTrue(true);
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
        $user = factory(User::class)->create($data);
        $this->assertEquals($users_count_before + 1, User::all()->count());

        $users_count_before = User::all()->count();

        $this->expectExceptionCode(23000);
        $this->expectExceptionMessageRegExp('/Duplicate entry/');

        $user = factory(User::class)->create($data);


    }

    /**
     * Check don't create user with the empty data
     * @expectException QueryException
     */

    public function testCreateUserFailsEmpty()
    {
        $data['name'] = null;
        $data['email'] = null;
        $users_count_before = User::all()->count();
        $this->expectExceptionMessageRegExp('/ cannot be null/');
        $this->expectException(QueryException::class);
        $this->expectExceptionCode(23000);

        $user = factory(User::class)->create($data);
    }

    public function testDeleteUser()
    {

        $data['name'] = 'test_user2';
        $data['email'] = 'test_user2@test.ru';
        $res = User::where('name', $data['name'])->delete();


        $this->assertDatabaseMissing('users', [
            'name' => $data['name'],
        ]);
    }
}
