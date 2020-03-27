<?php

namespace Tests\Feature\Controllers\Web\Admin;

use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\NewsGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class NewsControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function testIndexAvailableForAdministrators()
    {
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->get(route('admin.news.index'))
            ->assertStatus(200);
    }

    public function testIndexAvailableForModerators()
    {
        $user = UserGenerator::createModeratorUser();

        $this->actingAs($user)
            ->get(route('admin.news.index'))
            ->assertStatus(200);
    }

    public function testIndexAvailableForSimpleUser()
    {
        $user = UserGenerator::createUser();

        $this->actingAs($user)
            ->get(route('admin.news.index'))
            ->assertStatus(403);
    }

    public function testIndexWithNews()
    {
        $news = NewsGenerator::createNewsTutorial();
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)
            ->get(route('admin.news.index'))
            ->assertStatus(200)
            ->assertSeeText($news->name);
    }

    public function testCreateNews()
    {
        $data = $this->generateNewsCreateData();
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->post(route('admin.news.store'), $data);

        $this->assertDatabaseHas('news', [
            'name' => $data['name']
        ]);
    }

    public function testDestroyNews() {
        $data = $this->generateNewsCreateData();
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->post(route('admin.news.store'), $data);

        $this->assertGreaterThan(0, News::all()->count());

        $user = UserGenerator::createAdminUser();

        foreach (News::all() as $news) {
            $this->actingAs($user)
                ->delete(route('admin.news.destroy', ['news' => $news]))
                ->assertStatus(200);
        }

        $this->assertEquals(0, News::all()->count());
    }

    public function testCreatePageAvailableForAdministrators()
    {
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->get(route('admin.news.create'))
            ->assertStatus(200);
    }

    public function testCreatePageAvailableForModerators()
    {
        $user = UserGenerator::createModeratorUser();

        $this->actingAs($user)
            ->get(route('admin.news.create'))
            ->assertStatus(200);
    }

    public function testCreatePageUnavailableForSimpleUser()
    {
        $user = UserGenerator::createUser();

        $this->actingAs($user)
            ->get(route('admin.news.create'))
            ->assertStatus(403);
    }

    public function testEditPageAvailableForAdministrators()
    {
        $user = UserGenerator::createAdminUser();
        $news = NewsGenerator::createNews();

        $this->actingAs($user)
            ->get(route('admin.news.edit', $news['id']))
            ->assertStatus(200);
    }

    public function testEditPageUnavailableForSimpleUser()
    {
        $user = UserGenerator::createUser();
        $news = NewsGenerator::createNews();

        $this->actingAs($user)
            ->get(route('admin.news.edit', $news))
            ->assertStatus(403);
    }

    public function testShowPageAvailableForAdministrators()
    {
        $user = UserGenerator::createAdminUser();
        $news = NewsGenerator::createNews();

        $this->actingAs($user)
            ->get(route('admin.news.show', $news['id']))
            ->assertStatus(200);
    }

    public function testShowPageUnavailableForSimpleUser()
    {
        $user = UserGenerator::createUser();
        $news = NewsGenerator::createNews();

        $this->actingAs($user)
            ->get(route('admin.news.show', $news))
            ->assertStatus(403);
    }

    public function testCreateNewsStoresOnlyNews()
    {
        $data = $this->generateNewsCreateData();
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->post(route('admin.news.store'), $data);

        $this->assertEquals(1, News::all()->count());
    }

    public function testCreateNewsWontCreateNewsWithTheSameName()
    {
        $data = $this->generateNewsCreateData();
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->post(route('admin.news.store'), $data);
        $this->actingAs($user)
            ->post(route('admin.news.store'), $data);

        $this->assertEquals(1, News::all()->count());
    }

    public function testUnAuthenticatedUserWontCreateNewsAndRedirectOnLogin()
    {
        \Mail::fake();
        $data = $this->generateNewsCreateData();
        $this->post(route('admin.news.store'), $data)
            ->assertStatus(302)
            ->assertRedirect(route('login'));
        \Mail::assertNothingSent();
    }

    public function testWontCreateNewsWithoutDescriptionText()
    {
        $user = UserGenerator::createAdminUser();
        $data = $this->generateNewsCreateData();
        unset($data['description']);
        $this->actingAs($user)
            ->post(route('admin.news.store'), $data)
            ->assertStatus(302)
            ->assertSessionHasErrors([
                'description'
            ]);

        $this->assertDatabaseMissing('news', [
            'name' => $data['name'],
        ]);
    }

    public function testCreateNewsFailsIfNameIsEmpty()
    {
        $user = UserGenerator::createAdminUser();
        $data = $this->generateNewsCreateData();
        unset($data['name']);
        $this->actingAs($user)
            ->post(route('admin.news.store'), $data)
            ->assertSessionHasErrors([
                'name'
            ]);

        $this->assertDatabaseMissing('news', [
            'name' => '',
        ]);
    }

    public function testUpdateNews()
    {
        $user = UserGenerator::createAdminUser();
        $news = NewsGenerator::createNews();

        $name = $this->faker->realText(20) . microtime(true);
        $description = $this->faker->realText(100) . microtime(true);
        $this->actingAs($user)
            ->patch(route('admin.news.update', [
                'news' => $news->id,
            ]), [
                'name' => $name,
                'description' => $description,
            ])
            ->assertStatus(302);

        $news->refresh();

        $this->assertEquals($news->name, $name);
        $this->assertEquals($news->description, $description);
    }

    private function generateNewsCreateData(): array
    {
        return [
            'name' => $this->faker->realText(20),
            'description' => $this->faker->realText(100)
        ];
    }
}
