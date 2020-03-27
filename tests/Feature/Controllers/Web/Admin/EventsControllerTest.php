<?php

namespace Tests\Feature\Controllers\Web\Admin;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\EventGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class EventsControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function testIndexWithEvents()
    {
        $event = EventGenerator::createEventTraditional();
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)
            ->get(route('admin.events.index'))
            ->assertStatus(200)
            ->assertSeeText($event->name);
    }

    public function testIndexUnavailableForSimpleUser()
    {
        $user = UserGenerator::createUser();

        $this->actingAs($user)
            ->get(route('admin.events.index'))
            ->assertStatus(403);
    }

    public function testCreateEvent()
    {
        $data = EventGenerator::generateEventCreateData();
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->post(route('admin.events.store'), $data);

        $this->assertDatabaseHas('events', [
            'region' => $data['region']
        ]);
    }

    public function testCreateEventStoresOnlyEvent()
    {
        $data = EventGenerator::generateEventCreateData();
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->post(route('admin.events.store'), $data);

        $this->assertEquals(1, Event::all()->count());
    }

    public function testUnAuthenticatedUserWontCreateEventAndRedirectOnLogin()
    {
        \Mail::fake();
        $data = EventGenerator::generateEventCreateData();
        $this->post(route('admin.events.store'), $data)
            ->assertStatus(302)
            ->assertRedirect(route('login'));
        \Mail::assertNothingSent();
    }

    public function testCreateEventFailsIfNameIsEmpty()
    {
        $user = UserGenerator::createAdminUser();
        $data = EventGenerator::generateEventCreateData();
        unset($data['description']);
        $this->actingAs($user)
            ->post(route('admin.events.store'), $data)
            ->assertSessionHasErrors([
                'description'
            ]);

        $this->assertDatabaseMissing('events', [
            'description' => '',
        ]);
    }

    public function testDestroyEvent() {
        $data = EventGenerator::generateEventCreateData();
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->post(route('admin.events.store'), $data);

        $this->assertGreaterThan(0, Event::all()->count());

        $user = UserGenerator::createAdminUser();

        foreach (Event::all() as $event) {
            $this->actingAs($user)
                ->delete(route('admin.events.destroy', ['event' => $event]))
                ->assertStatus(200);
        }

        $this->assertEquals(0, Event::all()->count());
    }

    public function testCreatePageAvailableForAdministrators()
    {
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->get(route('admin.events.create'))
            ->assertStatus(200);
    }

    public function testCreatePageUnavailableForSimpleUser()
    {
        $user = UserGenerator::createUser();

        $this->actingAs($user)
            ->get(route('admin.events.create'))
            ->assertStatus(403);
    }

    public function testEditPageAvailableForAdministrators()
    {
        $user = UserGenerator::createAdminUser();
        $event = EventGenerator::createEvent();

        $this->actingAs($user)
            ->get(route('admin.events.edit', $event['id']))
            ->assertStatus(200);
    }

    public function testEditPageUnavailableForSimpleUser()
    {
        $user = UserGenerator::createUser();
        $event = EventGenerator::createEvent();

        $this->actingAs($user)
            ->get(route('admin.events.edit', $event))
            ->assertStatus(403);
    }

    public function testShowPageAvailableForAdministrators()
    {
        $user = UserGenerator::createAdminUser();
        $event = EventGenerator::createEvent();

        $this->actingAs($user)
            ->get(route('admin.events.show', $event['id']))
            ->assertStatus(200);
    }

    public function testShowPageUnavailableForSimpleUser()
    {
        $user = UserGenerator::createUser();
        $event = EventGenerator::createEvent();

        $this->actingAs($user)
            ->get(route('admin.events.show', $event))
            ->assertStatus(403);
    }
}
