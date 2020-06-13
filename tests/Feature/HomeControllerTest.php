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
        $response = $this->actingAs($user)
            ->get(route('home.index'))
            ->assertStatus(200);

        $response->assertViewHas('pages');

    }

    public function  testCreate()
    {

        $user = factory(User::class)->make();
        $response = $this->actingAs($user)
            ->get(route('home.create'))
            ->assertStatus(200);

        $response->original->getData()['divisionList'];
        $response->original->getData()['townList'];

    }

    public function testUnAuthenticatedUserWontCreateAdvertAndRedirectOnLogin()
    {
        $this->get(route('home.create'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));

    }

    public function  testStoreNewAdvert()
    {
        $this->withoutMiddleware();

        $user = factory(User::class)->create(); //созд. юзера чз фабрику, можно через сидер
        $this->actingAs($user); //создать объявление от имени этого юзера

        //$this->assertDatabaseMissing('adverts', $data);  // есть ли в базе
        $data = $this->getExampleData();
        $response = $this->post(route('home.store'), $data);  //
        $this->assertDatabaseHas('adverts', $data);  // добавилось ли в базу

        $response->assertRedirect(route('home.index')); //проверяем редирект
    }

    public function testShow()
    {
        $user = factory(User::class)->make();

        $this->actingAs($user)->get(route('adverts.show', ['advert'=>'1']))
            ->assertStatus(200)
            ->original->getData()['advert'];

    }

    public function getExampleData()
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
