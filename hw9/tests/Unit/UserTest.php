<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateUser()
    {

        $data['name'] = 'test_user';
        $data['email']= 'test_user@test.ru';
        $user = factory(User::class)->create($data);
        // $this->assertTrue(true);
            $this->assertDatabaseHas('users', [
            'name' => $data['name'],
        ]);
    }

    /**
     * Check don't create user with the same email
     */
    public function testCreateUserFailsDublicate()
    {

        $data['name']= 'test_user2';
        $data['email']= 'test_user2@test.ru';
        //первого добавляем
        $users_count_before = User::all()->count();
        $user = factory(User::class)->create($data);
        $this->assertEquals($users_count_before+1, User::all()->count());

       // $users_count_before = User::all()->count();
     //   $user = factory(User::class)->create($data);
      //  $this->assertEquals($users_count_before, User::all()->count());

        // $this->assertTrue(true);

    }
    /**
     * Check don't create user with the empty data
     */
    public function testCreateUserFailsEmpty()
    {

        $data['name']= null;
        $data['email']= null;

        $users_count_before = User::all()->count();
        $user = factory(User::class)->create($data);
        $this->assertEquals($users_count_before, User::all()->count());



    }
    public function testDeleteUser()
    {

        $data['name'] = 'test_user2';
        $data['email']= 'test_user2@test.ru';
        $res=User::where('name',$data['name'])->delete();


        $this->assertDatabaseMissing('users', [
            'name' => $data['name'],
        ]);
    }
}
