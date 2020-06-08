<?php

namespace Tests\Feature;

use App\Models\Advert;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
        $this->actingAs($user)
            ->get(route('adverts.index'))
            ->assertStatus(200);

        $response = $this->call('GET', 'adverts');
        $response->assertViewHas('advertList');
    }

    public function  testCreate()
    {

        $user = factory(User::class)->make();
        $this->actingAs($user)
            ->get(route('adverts.create'))
            ->assertStatus(200);

        $this->actingAs($user)->get('adverts/create')->original->getData()['divisionList'];
        $this->actingAs($user)->get('adverts/create')->original->getData()['townList'];

    }

    public function testUnAuthenticatedUserWontCreateAdvertAndRedirectOnLogin()
    {
        $this->get(route('adverts.create'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));

    }

    public function  testStoreNewAdvert()
    {
        $user = factory(User::class)->make();
        $this->actingAs($user);

        //$this->assertDatabaseMissing('adverts', $data);
        $data = $this->getData();
        $response = $this->post(route('adverts.store'), $data);
        $this->assertDatabaseHas('adverts', $data);

        $response->assertRedirect(route('adverts.index'));
    }

    public function testShow()
    {
        $this->get(route('adverts.show'))
            ->assertStatus(200)
            ->original->getData()['advert'];
    }

    public function testEdit()
    {
        $user = factory(User::class)->make();
        $this->actingAs($user)
            ->get(route('adverts.edit', ['advert'=>'1']))
            ->assertStatus(200);

        $this->actingAs($user)->get(route('adverts.edit', ['advert'=>'1']))->original->getData()['advert'];

    }

    public function testUpdate()
    {
        $user = factory(User::class)->make();
        $this->actingAs($user);

        $advert = factory(Advert::class)->create(); //(['user_id'=>$user->id]);
        $advert->title = 'update title';

       $this->put(route('adverts.update',['advert'=>$advert->id]), $advert->toArray());
       $this->assertDatabaseHas('adverts',['id'=>$advert->id, 'title'=>'update title']);

    }

    public function testDestroy()
    {
        $user = factory(User::class)->make();
        $this->actingAs($user);

        $advert = factory(Advert::class)->create();
        $this->delete(route('adverts.update',['advert'=>$advert->id]));
        $this->assertDatabaseMissing('adverts', ['id'=>$advert->id]);
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
