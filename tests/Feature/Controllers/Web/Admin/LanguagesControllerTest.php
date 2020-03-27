<?php

namespace Tests\Feature\Controllers\Web\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\LanguageGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class LanguagesControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function testIndexAvailableForAdministrators()
    {
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->get(route('admin.languages.index'))
            ->assertStatus(200);
    }

    public function testIndexAvailableForModerators()
    {
        $user = UserGenerator::createModeratorUser();

        $this->actingAs($user)
            ->get(route('admin.languages.index'))
            ->assertStatus(200);
    }

    public function testIndexUnavailableForSimpleUser()
    {
        $user = UserGenerator::createUser();

        $this->actingAs($user)
            ->get(route('admin.languages.index'))
            ->assertStatus(403);
    }

    public function testUnAuthenticatedUserWontcreateLanguageAndRedirectOnLogin()
    {
        \Mail::fake();
        $data = LanguageGenerator::generateLanguageCreateData();
        $this->post(route('admin.languages.store'), $data)
            ->assertStatus(302)
            ->assertRedirect(route('login'));
        \Mail::assertNothingSent();
    }

    public function testCreatePageAvailableForAdministrators()
    {
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->get(route('admin.languages.create'))
            ->assertStatus(200);
    }

    public function testCreatePageAvailableForModerators()
    {
        $user = UserGenerator::createModeratorUser();

        $this->actingAs($user)
            ->get(route('admin.languages.create'))
            ->assertStatus(200);
    }

    public function testCreatePageUnavailableForSimpleUser()
    {
        $user = UserGenerator::createUser();

        $this->actingAs($user)
            ->get(route('admin.languages.create'))
            ->assertStatus(403);
    }

    public function testEditPageAvailableForAdministrators()
    {
        $user = UserGenerator::createAdminUser();
        $language = LanguageGenerator::createLanguage();

        $this->actingAs($user)
            ->get(route('admin.languages.edit', $language['id']))
            ->assertStatus(200);
    }

    public function testEditPageUnavailableForSimpleUser()
    {
        $user = UserGenerator::createUser();
        $language = LanguageGenerator::createLanguage();

        $this->actingAs($user)
            ->get(route('admin.languages.edit', $language))
            ->assertStatus(403);
    }

    public function testShowPageAvailableForAdministrators()
    {
        $user = UserGenerator::createAdminUser();
        $language = LanguageGenerator::createLanguage();

        $this->actingAs($user)
            ->get(route('admin.languages.show', $language['id']))
            ->assertStatus(200);
    }

    public function testShowPageUnavailableForSimpleUser()
    {
        $user = UserGenerator::createUser();
        $language = LanguageGenerator::createLanguage();

        $this->actingAs($user)
            ->get(route('admin.languages.show', $language))
            ->assertStatus(403);
    }
}
