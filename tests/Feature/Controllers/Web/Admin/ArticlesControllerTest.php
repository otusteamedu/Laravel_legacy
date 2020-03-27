<?php

namespace Tests\Feature\Controllers\Web\Admin;

use App\Models\Article;
use App\Services\Articles\Repositories\ArticleRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\ArticleGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class ArticlesControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /**
     * @return ArticleRepositoryInterface
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function getArticleRepository(): ArticleRepositoryInterface
    {
        return app()->make(ArticleRepositoryInterface::class);
    }

    public function testIndexAvailableForAdministrators()
    {
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->get(route('admin.articles.index'))
            ->assertStatus(200);
    }

    public function testIndexAvailableForModerators()
    {
        $user = UserGenerator::createModeratorUser();

        $this->actingAs($user)
            ->get(route('admin.articles.index'))
            ->assertStatus(200);
    }

    public function testIndexUnavailableForSimpleUser()
    {
        $user = UserGenerator::createUser();

        $this->actingAs($user)
            ->get(route('admin.articles.index'))
            ->assertStatus(403);
    }

    public function testIndexWithArticles()
    {
        $article = ArticleGenerator::createArticleTutorial();
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)
            ->get(route('admin.articles.index'))
            ->assertStatus(200)
            ->assertSeeText($article->name);
    }

    public function testCreateArticle()
    {
        $data = $this->generateArticleCreateData();
        $this->createArticle($data);

        $this->assertDatabaseHas('articles', [
            'name' => $data['name']
        ]);
    }

    public function testCreateArticleStoresOnlyArticle()
    {
        $data = $this->generateArticleCreateData();
        $this->createArticle($data);

        $this->assertEquals(1, Article::all()->count());
    }

    public function testCreateArticleWontCreateArticleWithTheSameName()
    {
        $data = $this->generateArticleCreateData();

        $this->createArticle($data);
        $this->createArticle($data);

        $this->assertEquals(1, Article::all()->count());
    }

    public function testUnAuthenticatedUserWontCreateArticleAndRedirectOnLogin()
    {
        \Mail::fake();
        $data = $this->generateArticleCreateData();
        $this->post(route('admin.articles.store'), $data)
            ->assertStatus(302)
            ->assertRedirect(route('login'));
        \Mail::assertNothingSent();
    }

    public function testWontCreateArticleWithoutDescriptionText()
    {
        $user = UserGenerator::createAdminUser();
        $data = $this->generateArticleCreateData();
        unset($data['description']);
        $this->actingAs($user)
            ->post(route('admin.articles.store'), $data)
            ->assertStatus(302)
            ->assertSessionHasErrors([
                'description'
            ]);

        $this->assertDatabaseMissing('articles', [
            'name' => $data['name'],
        ]);
    }

    public function testCreateArticleFailsIfNameIsEmpty()
    {
        $user = UserGenerator::createAdminUser();
        $data = $this->generateArticleCreateData();
        unset($data['name']);
        $this->actingAs($user)
            ->post(route('admin.articles.store'), $data)
            ->assertSessionHasErrors([
                'name'
            ]);

        $this->assertDatabaseMissing('articles', [
            'name' => '',
        ]);
    }

    public function testUpdateArticle()
    {
        $user = UserGenerator::createAdminUser();
        $article = ArticleGenerator::createArticle();

        $name = $this->faker->realText(20) . microtime(true);
        $description = $this->faker->realText(100) . microtime(true);
        $this->actingAs($user)
            ->patch(route('admin.articles.update', [
                'article' => $article->id,
            ]), [
                'name' => $name,
                'description' => $description,
            ])
            ->assertStatus(302);

        $article->refresh();

        $this->assertEquals($article->name, $name);
        $this->assertEquals($article->description, $description);
    }

    public function testDestroyArticle() {
        $data = $this->generateArticleCreateData();
        $this->createArticle($data);

        $this->assertGreaterThan(0, Article::all()->count());

        $user = UserGenerator::createAdminUser();

        foreach (Article::all() as $article) {
            $this->actingAs($user)
                ->delete(route('admin.articles.destroy', ['article' => $article]))
                ->assertStatus(200);
        }

        $this->assertEquals(0, Article::all()->count());
    }

    public function testCreatePageAvailableForAdministrators()
    {
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->get(route('admin.articles.create'))
            ->assertStatus(200);
    }

    public function testCreatePageAvailableForModerators()
    {
        $user = UserGenerator::createModeratorUser();

        $this->actingAs($user)
            ->get(route('admin.articles.create'))
            ->assertStatus(200);
    }

    public function testCreatePageUnavailableForSimpleUser()
    {
        $user = UserGenerator::createUser();

        $this->actingAs($user)
            ->get(route('admin.articles.create'))
            ->assertStatus(403);
    }

    public function testEditPageAvailableForAdministrators()
    {
        $user = UserGenerator::createAdminUser();
        $article = ArticleGenerator::createArticle();

        $this->actingAs($user)
            ->get(route('admin.articles.edit', $article['id']))
            ->assertStatus(200);
    }

    public function testEditPageAvailableForModerators()
    {
        $user = UserGenerator::createModeratorUser();
        $article = ArticleGenerator::createArticle();

        $status = $this->actingAs($user)
            ->get(route('admin.articles.edit', $article['id']))
            ->status();

        $this->assertNotEquals($status, 200);
    }

    public function testEditPageUnavailableForSimpleUser()
    {
        $user = UserGenerator::createUser();
        $article = ArticleGenerator::createArticle();

        $this->actingAs($user)
            ->get(route('admin.articles.edit', $article))
            ->assertStatus(403);
    }

    public function testShowPageAvailableForAdministrators()
    {
        $user = UserGenerator::createAdminUser();
        $article = ArticleGenerator::createArticle();

        $this->actingAs($user)
            ->get(route('admin.articles.show', $article['id']))
            ->assertStatus(200);
    }

    public function testShowPageUnavailableForSimpleUser()
    {
        $user = UserGenerator::createUser();
        $article = ArticleGenerator::createArticle();

        $this->actingAs($user)
            ->get(route('admin.articles.show', $article))
            ->assertStatus(403);
    }

    private function generateArticleCreateData(): array
    {
        return [
            'name' => $this->faker->realText(20),
            'description' => $this->faker->realText(100)
        ];
    }

    /**
     * @param array $data
     * @return \Illuminate\Testing\TestResponse
     */
    private function createArticle(array $data)
    {
        $user = UserGenerator::createAdminUser();

        return $this->actingAs($user)
            ->post(route('admin.articles.store'), $data);
    }
}
