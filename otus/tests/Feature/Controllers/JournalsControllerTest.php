<?php

namespace Tests\Feature\Controllers;

use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Journal;
use App\Models\Handbook;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class JournalsControllerTest extends TestCase {

    use RefreshDatabase;
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     * @group controllers
     */


    public function testCreateJournalIfInvalidUserIdParam() {
        $user = UserGenerator::createEditorUser();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.journals.store'), [
                'status_id' => factory(Handbook::class)->create()->id
            ])
            ->assertSessionHasErrors();
    }

    public function testCreateJournalIfInvalidStatusIdParam() {
        $user = UserGenerator::createEditorUser();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.journals.store'), [
                'user_id' => factory(User::class)->create()->id,
            ])
            ->assertSessionHasErrors();
    }

    public function testFailDeleteJournal() {
        $user = UserGenerator::createSimpleUser();
        /** @var Collection $collection */

        $collection = factory(\App\Models\Journal::class, 1)->create();
        /** @var Journal $item */
        $item = $collection->get(0);

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->delete(route('admin.journals.destroy', ['journal' => $item]))
            ->assertStatus(403);
    }

    public function testSuccessStoreJournal() {
        $user = UserGenerator::createEditorUser();
        $Journal = $this->createJournal();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.journals.store'), $Journal)
            ->assertStatus(301);

        $this->assertDatabaseHas('journals', [
            'user_id' => $Journal['user_id']
        ]);
    }

    public function testCreatedOnlyOneJournal() {
        $user = UserGenerator::createEditorUser();
        $Journal = $this->createJournal();

        $count = Journal::all()->count();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.journals.store'), $Journal)
            ->assertStatus(301);

        $this->assertEquals($count + 1, Journal::all()->count());
    }

    public function testSuccessDeleteJournal() {
        $user = UserGenerator::createEditorUser();
        /** @var Collection $collection */

        $count = Journal::all()->count();

        $collection = factory(\App\Models\Journal::class, 1)->create();
        /** @var Journal $item */
        $item = $collection->get(0);

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->delete(route('admin.journals.destroy', ['journal' => $item]))
            ->assertStatus(200);

        $this->assertEquals($count, Journal::all()->count());
    }

    private function createJournal() {
        return [
            'user_id' => factory(User::class)->create()->id,
            'status_id' => factory(Handbook::class)->create()->id
        ];
    }
}
