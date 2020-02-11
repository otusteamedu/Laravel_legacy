<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Services\OperationsService;

class StoreOperation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    protected $operationsService;

    /**
     * StoreOperation constructor.
     * @param $data
     * @param OperationsService $operationsService
     */
    public function __construct($data, OperationsService $operationsService)
    {
        $this->data = $data;
        $this->operationsService = $operationsService;
    }

    /**
     *  Execute the job.
     *
     * @param $number
     */
    public function handle()
    {
        $this->operationsService->storeOperation($this->data);
    }
}
