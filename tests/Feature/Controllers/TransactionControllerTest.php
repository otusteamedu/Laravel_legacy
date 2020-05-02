<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Generators\UserGenerator;

class TransactionControllerTest extends TestCase
{

    /**
     * @group Transaction
     */
    public function testUnregisteredUserIndex()
    {
        $this->get(route('admin.transaction.index'))->assertStatus(302);
    }

    /**
     * @group Transaction
     */
    public function testSimpleUserWontIndex()
    {
        $user = UserGenerator::createUser();
        $this->actingAs($user)
            ->get(route('admin.transaction.index'))
            ->assertStatus(403);
    }

    /**
     * @group Transaction
     */
    public function testAdminIndex()
    {
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)
            ->get(route('admin.transaction.index'))
            ->assertStatus(200);
    }

    /**
     * @group Transaction
     */
    public function testAdminCanCreateTransaction()
    {
        $user = UserGenerator::createAdminUser();
        $data = $this->generateTransactionData();

        $this->actingAs($user)->post(route('admin.transaction.store'), $data)
            ->assertStatus(302)
            ->assertRedirect(route('admin.transaction.index'));
    }

    /**
     * @group Transaction
     */
    public function testWontCreateTransactionWithoutRelations()
    {
        $user = UserGenerator::createAdminUser();
        $data = $this->generateTransactionData();
        unset($data['user_id']);
        unset($data['student_id']);
        unset($data['reason_id']);
        $this->actingAs($user)
            ->post(route('admin.transaction.store'), $data)
            ->assertStatus(302)
            ->assertSessionHasErrors([
                'user_id', 'student_id', 'reason_id'
            ]);

        $this->assertDatabaseMissing('transaction', [
            'user_id' => $data['user_id'],
            'student_id' => $data['student_id'],
            'reason_id' => $data['reason_id'],
        ]);
    }

    public function generateTransactionData()
    {
        return [
            'user_id' => rand(1, 10),
            'student_id' => rand(1, 10),
            'reason_id' => rand(1, 10),
            'amount' => 1000,
        ];
    }

}
