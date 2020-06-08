<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    //use RefreshDatabase; //очистка БД

    /**
     * Class HomeTest
     * @package Test\Feature
     * @group home
     */

    public function testIndex()
    {
        $user = factory(User::class)->make();
        $this->actingAs($user)
            ->get(route('home.index'))
            ->assertStatus(200);

        $response = $this->call('GET', 'home');
        $response->assertViewHas('pages');

    }

    public function  testCreate()
    {

        $user = factory(User::class)->make();
        $this->actingAs($user)
            ->get(route('home.create'))
            ->assertStatus(200);

        $this->actingAs($user)->get('home/create')->original->getData()['divisionList'];
        $this->actingAs($user)->get('home/create')->original->getData()['townList'];

    }

    public function testUnAuthenticatedUserWontCreateAdvertAndRedirectOnLogin()
    {
        $this->get(route('home.create'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));

    }

    public function  testStoreNewAdvert(){

        $user = factory(User::class)->make(); //созд. юзера чз фабрику, можно через сидер
        $this->actingAs($user); //создать объявление от имени этого юзера

        //$this->assertDatabaseMissing('adverts', $data);  // есть ли в базе
        $data = $this->getData();
        $response = $this->post(route('home.store'), $data);  //
        $this->assertDatabaseHas('adverts', $data);  // добавилось ли в базу

        $response->assertRedirect(route('home.index')); //проверяем редирект
    }

    public function testShow()
    {

        $this->get(route('home.show'))
            ->assertStatus(200)
            ->original->getData()['advert'];

    }

    public function getData()
    {
       return $data = [
            'division_id'=>2,
            'town_id'=>2,
            'title'=>'test1 title1',
            'price'=>600,
            'content'=>'2test content',
        ];
    }
}
