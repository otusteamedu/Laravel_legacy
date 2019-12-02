<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\StatsService;

class UpdateStats implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $statsService;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(StatsService $statsService)
    {
        $this->statsService = $statsService;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->statsService->updateRegions();
    }
}
