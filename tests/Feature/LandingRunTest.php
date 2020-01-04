<?php

namespace Tests\Feature;

use App\Http\Middleware\VerifyCsrfToken;
use App\Models\InsightsMetric;
use App\Models\Repository;
use App\Models\Run;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\MocksTrait;
use Tests\TestCase;

class LandingRunTest extends TestCase
{
    use MocksTrait, RefreshDatabase;

    public function testRun()
    {
        $user = factory(User::class)->create();
        $this->withoutMiddleware(VerifyCsrfToken::class);

        // Mocking analyzers
        $this->mockPhpInsights();
        $this->mockPhpLoc();

        $url = $this->app->basePath();
        $res = $this->actingAs($user)
            ->post(route('landing.run'), ['url' => $url]);

        $run = Run::first();

        $res->assertRedirect(route('landing.result', $run));

        /** @var Repository $repository */
        $repository = Repository::where(['url' => $url])->withCount('commits')->first();
        $this->assertNotEmpty($repository);
        $this->assertGreaterThanOrEqual(1, $repository->commits_count);
    }

    public function testResult()
    {
        /** @var Run $run */
        $run = factory(Run::class)->create();

        /** @var InsightsMetric $insightsMetric */
        $insightsMetric = factory(InsightsMetric::class)->create([
            'commit_id' => $run->commit_id,
            'repository_id' => $run->repository_id,
        ]);

        $this->get(route('landing.result', $run->id))
            ->assertStatus(200)
            ->assertSeeText($insightsMetric->code . '%')
            ->assertSeeText($insightsMetric->complexity . '%')
            ->assertSeeText($insightsMetric->architecture . '%')
            ->assertSeeText($insightsMetric->style . '%');
    }

    public function testEmptyUrl()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class);
        $this->post(route('landing.run'), ['url' => ''])
            ->assertRedirect(route('landing.index'));
    }

    public function testInvalidUrl()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class);

        $url = 'asdasd';
        $this->post(route('landing.run'), ['url' => $url])
            ->assertSeeText(trans('errors.invalid_url', ['url' => $url]));
    }
}
