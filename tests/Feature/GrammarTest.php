<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\Grammar;
use DB;
use App\User;
use Tests\Generators\Generator;



class GrammarTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testIndex()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    public function testRedirectLogin()
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/login');
    }
    public function testAdminUser()
    {
       $this->assertDatabaseHas('users',[
          'name'=>'admin'
        ]);
    }
    public function testGrammarList(){
        $response = $this->get(route('grammList'));
        $response->assertStatus(200);
    }
    public function testGrammarPages(){
        $grammar=Grammar::all();
        foreach ($grammar as $item){
            $response = $this->get('/grammatika/'.$item->id);
            $response->assertStatus(200);
        }
    }

    public function testAdminGrammar()
    {
        $user=User::find(1);
        $response=$this->actingAs($user)
            ->get(route('admin.grammar.index'));
        $response->assertStatus(200);
    }


    public function testCreateAdminGrammar()
    {
        $user = User::find(1);
        $data = Generator::getCreateGrammarData();
        $count=Grammar::all()->count();
        $this->actingAs($user)->post(route('admin.grammar.store'),$data);
        $this->assertEquals($count+1, Grammar::all()->count());
    }

    public function testUpdateAdminGrammar()
    {
        $user = User::find(1);
        $id=1;
        $update=[
            'name'=>'12343'
        ];
        $data = Generator::getUpdateGrammarData($id,$update);
        $this->actingAs($user)->put("admin/grammar/{$id}",$data);
        //$this->actingAs($user)->put(route('/admin/grammar.update',['grammar'=>$id]),$data);
        $grammar=Grammar::find($id);
        foreach ($update as $key=>$item) {
            $this->assertEquals($item, $grammar->$key);
        }
    }

}
