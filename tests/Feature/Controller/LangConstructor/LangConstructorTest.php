<?php

namespace Tests\Feature\Controller\LangConstructor;

use App\Models\Account;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\LangConstructorTypeGenerator;
use Tests\Generators\LangConstructorGenerator;
use Tests\Generators\AccountGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class LangConstructorTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testIndex()
    {
        $account = AccountGenerator::createAccountAdminUser();
        $user = UserGenerator::createUser(['account_id' => $account->id]);


        $this->actingAs($user)
            ->get(route('lang-constructor-index'))
            ->assertStatus(200);
    }

    public function testEditUserWonConstructor()
    {

        $account = AccountGenerator::createAccountAdminUser();

        $user = UserGenerator::createUser(['account_id' =>$account->id]);


        $this->actingAs($user)
            ->get(route('lang-constructor-edit'))
            ->assertStatus(200);

    }

    public function testAccessUserConstructor()
    {

        $account = AccountGenerator::createAccount();

        $user = UserGenerator::createUser(['account_id' =>$account->id]);

        $this->actingAs($user)
            ->get(route('lang-constructor-edit'))
            ->assertStatus(403);

    }

    public function testCreateUserWonConstructor()
    {

        $account = AccountGenerator::createAccountAdminUser();

        $user = UserGenerator::createUser(['account_id' =>$account->id]);

;
        $langConstructorType = LangConstructorTypeGenerator::createConstructorType(['created_account_id' => $account->id]);
        $langConstructor = LangConstructorGenerator::makeConstructor(['type_code'=>$langConstructorType->code,'created_account_id' => $account->id]);

        $this->actingAs($user)
            ->post(route('lang-constructor-save'), $langConstructor->toArray())
            ->assertStatus(302);

        $this->assertDatabaseHas('constructions', [
            'code' => $langConstructor->code,
        ]);

    }

    /**
     * @group cms
     */

    public function testUpdateConstructorWonUpdateWithTheSameName()
    {
        $account = AccountGenerator::createAccountAdminUser();

        $user = UserGenerator::createUser(['account_id' => $account->id]);


        $langConstructorType = LangConstructorTypeGenerator::createConstructorType(['created_account_id' => $account->id]);
        $langConstructor = LangConstructorGenerator::makeConstructor(['type_code'=>$langConstructorType->code,'created_account_id' => $account->id]);

        $langConstructor->name = 'some name';

        $this->actingAs($user)
            ->post(route('lang-constructor-save'), $langConstructor->toArray())
            ->assertStatus(302);

        $this->assertDatabaseHas('constructions', [
            'name' => $langConstructor->name,
        ]);
    }


}
