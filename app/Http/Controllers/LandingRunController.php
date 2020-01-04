<?php

namespace App\Http\Controllers;

use App\Exceptions\UrlParseException;
use App\Helpers\UrlHelpers;
use App\Http\Requests\LandingRunRequest;
use App\Models\InsightsMetric;
use App\Models\Run;
use App\Services\GitOperations;
use App\Services\HistoryService;
use App\Services\RunService;

class LandingRunController extends Controller
{
    private const LOC_HISTORY_DEPTH_TO_RENDER = 50;

    public function run(
        LandingRunRequest $request,
        RunService $runService,
        HistoryService $historyService,
        GitOperations $gitOperations
    ) {
        $requestedUrl = $request->getRequestedUrl();
        if (!$requestedUrl) {
            return redirect(route('landing.index'));
        }

        \Log::info('Public run: ' . $requestedUrl);

        try {

            $run = $runService->createRunForUrl($requestedUrl, $request->user(), $request->ip());

            if (!UrlHelpers::isValidRepositoryUrl($run->url)) {
                throw new UrlParseException($run->url);
            }

            $sourceDir = $gitOperations->clone($run->url, self::LOC_HISTORY_DEPTH_TO_RENDER);

            // Execute all needed analyzers for landing page, results will be stored in $run object
            $runService->exec($run, $sourceDir);

            // Analyzing history only for PHPLOC
            $historyService->collectHistory(
                $sourceDir,
                null,
                $run->repository_id,
                HistoryService::ANALYZE_PHPLOC,
                self::LOC_HISTORY_DEPTH_TO_RENDER
            );

            return redirect(route('landing.result', $run));

        } catch (\Exception $e) {

            $error = $e->getMessage();
            if ($e instanceof UrlParseException) {
                $error = trans('errors.invalid_url', ['url' => $requestedUrl]);
            }
            return view('landing.run.error', ['error' => $error, 'url' => $requestedUrl]);

        }
    }

    public function result(Run $run, HistoryService $historyService)
    {
        // Load PHP Insights results for this run
        /** @var InsightsMetric $insightsMetric */
        $insightsMetric = InsightsMetric::where([
            'commit_id' => $run->commit_id,
            'project_id' => null,
        ])->first();

        // Load collected information about PHPLOC history
        $locHistory = $historyService->loadLocHistory($run->repository_id, null, self::LOC_HISTORY_DEPTH_TO_RENDER);
        return view('landing.run.result', compact('run', 'insightsMetric', 'locHistory'));
    }
}
