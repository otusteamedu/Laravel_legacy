<?php

namespace Tests\Feature\Controllers\Api;

use App\Models\Grammar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\Generators\Generator;
use Tests\TestCase;
use App\User;

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
        $user=User::find(1);
        Passport::actingAs($user);
        $this->json(
            'GET',
            route('api.grammar.index')
        )->assertStatus(200);
    }

    public function testGrammarPage()
    {
        $user=User::find(1);
        Passport::actingAs($user);

        $grammar=Grammar::first();
        $this->json('GET',route('api.grammar.show',
                [
                    'grammar'=>$grammar->id
                ]))->assertStatus(200);

    }
    public function testUpdateGrammarPage(){

        $user=User::find(1);
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

        $user=User::find(1);
        Passport::actingAs($user);
        //$grammar=Grammar::first();
        $data = Generator::getCreateGrammarData();
        $response=$this->json('POST',
            route('api.grammar.store'),$data);
        $response->assertJson($data);
    }
}
