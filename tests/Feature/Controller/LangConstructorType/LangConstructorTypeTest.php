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

class LangConstructorTypeTest extends TestCase
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
            ->get(route('lang-constructor-type-index'))
            ->assertStatus(200);
    }

    public function testEditUserWontConstructor()
    {

        $account = AccountGenerator::createAccountAdminUser();

        $user = UserGenerator::createUser(['account_id' =>$account->id]);


        $this->actingAs($user)
            ->get(route('lang-constructor-type-edit'))
            ->assertStatus(200);

    }

    public function testAccessUserWithoutPrivilegedConstructor()
    {

        $account = AccountGenerator::createAccount();

        $user = UserGenerator::createUser(['account_id' =>$account->id]);

        $this->actingAs($user)
            ->get(route('lang-constructor-type-edit'))
            ->assertStatus(403);

    }

    public function testCreateUserWontConstructor()
    {

        $account = AccountGenerator::createAccountAdminUser();
        $user = UserGenerator::createUser(['account_id' =>$account->id]);

        $langConstructorType = LangConstructorTypeGenerator::createConstructorType(['created_account_id' => $account->id]);

        $this->actingAs($user)
            ->post(route('lang-constructor-type-save'), $langConstructorType->toArray())
            ->assertStatus(302);

        $this->assertDatabaseHas('construction_types', [
            'code' => $langConstructorType->code,
        ]);

    }

    /**
     * @group cms
     */

    public function testUpdateConstructorWontUpdateWithTheSameName()
    {



        $account = AccountGenerator::createAccountAdminUser();

        $user = UserGenerator::createUser(['account_id' => $account->id]);


        $langConstructorType = LangConstructorTypeGenerator::makeConstructorType(['created_account_id' => $account->id]);

        $langConstructorType->name = 'some name';

        $this->actingAs($user)
            ->post(route('lang-constructor-type-save'), $langConstructorType->toArray())
            ->assertStatus(302);

        $this->assertDatabaseHas('construction_types', [
            'name' => $langConstructorType->name,
        ]);
    }

}
