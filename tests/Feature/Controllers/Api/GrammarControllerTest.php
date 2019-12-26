<?php

namespace Tests\Feature\Controllers\Api;

use App\Models\Grammar;
use Laravel\Passport\Passport;
use Tests\Generators\Generator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;
//use Illuminate\Foundation\Testing\RefreshDatabase;
//use Illuminate\Foundation\Testing\WithFaker;

class GrammarControllerTest extends TestCase
{

    //use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $user=UserGenerator::getAdminUser();
        Passport::actingAs($user);
        $this->json(
            'GET',
            route('api.grammar.index')
        )->assertStatus(200);
    }

    public function testGrammarPage()
    {
        $user=UserGenerator::getAdminUser();
        Passport::actingAs($user);

        $grammar=Grammar::first();
        $this->json('GET',route('api.grammar.show',
                [
                    'grammar'=>$grammar->id
                ]))->assertStatus(200);

    }
    public function testUpdateGrammarPage(){

        $user=UserGenerator::getAdminUser();
        Passport::actingAs($user);
        $grammar=Grammar::first();
        $update=[
            'name'=>'12343'
        ];
        $response=$this->json('PUT',route('api.grammar.update',[
            'grammar'=>$grammar->id
        ]),$update);
        $response->assertJson($update);
    }

    public function testCreateGrammarPage(){

        $user = UserGenerator::getAdminUser();
        Passport::actingAs($user);
        //$grammar=Grammar::first();
        $data = Generator::getCreateGrammarData();
        $response=$this->json('POST',
            route('api.grammar.store'),$data);
        $response->assertJson($data);
    }
}
