<?php

namespace Tests\Feature\Controllers;

use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Handbook;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class HandbooksControllerTest extends TestCase {

    use RefreshDatabase;
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     * @group controllers
     */

    public function testCreateHandbookIfInvalidNameParam() {
        $user = UserGenerator::createEditorUser();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.handbooks.store'), [
                'code' => 'test',
                'description' => 'test',
            ])
            ->assertSessionHasErrors();
    }

    public function testCreateHandbookIfInvalidCodeParam() {
        $user = UserGenerator::createEditorUser();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.handbooks.store'), [
                'name' => 'test',
                'description' => 'test',
            ])
            ->assertSessionHasErrors();
    }

    public function testCreateHandbookIfInvalidDescriptionParam() {
        $user = UserGenerator::createEditorUser();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.handbooks.store'), [
                'name' => 'test',
                'code' => 'test',
            ])
            ->assertSessionHasErrors();
    }

    public function testFailStoreHandbook() {
        $user = UserGenerator::createSimpleUser();
        $handbook = $this->createHandbook();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.handbooks.store'), $handbook)
            ->assertStatus(403);
    }

    public function testFailDeleteHandbook() {
        $user = UserGenerator::createSimpleUser();
        /** @var Collection $collection */

        $collection = factory(\App\Models\Handbook::class, 1)->create();
        /** @var Handbook $item */
        $item = $collection->get(0);

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->delete(route('admin.handbooks.destroy', ['handbook' => $item]))
            ->assertStatus(403);
    }

    public function testSuccessStoreHandbook() {
        $user = UserGenerator::createEditorUser();
        $handbook = $this->createHandbook();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.handbooks.store'), $handbook)
            ->assertStatus(301);

        $this->assertDatabaseHas('handbooks', [
            'name' => $handbook['name']
        ]);
    }

    public function testCreatedOnlyOneHandbook() {
        $user = UserGenerator::createEditorUser();
        $handbook = $this->createHandbook();

        $count = Handbook::all()->count();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.handbooks.store'), $handbook)
            ->assertStatus(301);

        $this->assertEquals($count + 1, Handbook::all()->count());
    }

    public function testSuccessDeleteHandbook() {
        $user = UserGenerator::createEditorUser();
        /** @var Collection $collection */

        $count = Handbook::all()->count();

        $collection = factory(\App\Models\Handbook::class, 1)->create();
        /** @var Handbook $item */
        $item = $collection->get(0);

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->delete(route('admin.handbooks.destroy', ['handbook' => $item]))
            ->assertStatus(200);

        $this->assertEquals($count, Handbook::all()->count());
    }

    private function createHandbook() {
        $date = new \DateTime();
        return [
            'code'=> 'HandbookCode_' . $date->getTimestamp(),
            'name' => 'HandbookName_' . $date->getTimestamp(),
            'description' => 'Test description'
        ];
    }
}
