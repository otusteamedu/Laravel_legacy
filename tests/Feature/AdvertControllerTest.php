<?php

namespace Tests\Feature;

use App\Models\Advert;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class AdvertControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)
            ->get(route('adverts.index'))
            ->assertStatus(200);

        $response->assertViewHas('advertList');
    }

    public function  testCreate()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)
            ->get(route('adverts.create'))
            ->assertStatus(200);

        $response->original->getData()['divisionList'];
        $response->original->getData()['townList'];

    }

    public function testUnAuthenticatedUserWontCreateAdvertAndRedirectOnLogin()
    {
        $this->get(route('adverts.create'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    public function  testStoreNewAdvert()
    {
        $this->withoutMiddleware();
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $data = $this->getExampleData();
        $response = $this->post(route('adverts.store'), $data);
        $this->assertDatabaseHas('adverts', $data);

        $response->assertRedirect(route('adverts.index'));
    }

    public function testShow()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)->get(route('adverts.show', ['advert'=>$user->id]))
            ->assertStatus(200)
            ->original->getData()['advert'];
    }

    public function testEdit()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('adverts.edit', $user->id))
            ->assertStatus(200)
            ->original->getData()['advert'];
    }

    public function testUpdate()
    {
        Session::start();
        $user = factory(User::class)->create();
        $this->actingAs($user)
              ->get(route('adverts.update', ['advert'=>'none']))
              ->assertStatus(404);

        $advert = factory(Advert::class)->create(); //(['user_id'=>$user->id]);
        $advert->title = 'update title';

       $this->put(route('adverts.update',
           [
               'advert'=>$advert->id,
               '_token' => Session::token()
           ]
       ), $advert->toArray());

       $this->assertDatabaseHas('adverts',['id'=>$advert->id, 'title'=>'update title']);
    }

    public function testDestroy()
    {
        Session::start();
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $advert = factory(Advert::class)->create();
        $this->actingAs($user)->delete(route('adverts.destroy',
            [
                'advert'=>$advert->id,
                '_token' => Session::token()
            ]
        ));

        $this->assertDatabaseMissing('adverts', ['id'=>$advert->id]);
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
