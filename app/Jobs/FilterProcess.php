<?php

namespace App\Jobs;

use App\Models\Filter;
use App\Services\Filters\Handlers\CreateFilterHandler;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FilterProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Filter
     */
    private $data = [];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $filter)
    {
        //
        $this->data = $filter;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(CreateFilterHandler $createFilterHandler)
    {
        $createFilterHandler->handle($this->data);
        echo self::class . '  RUN '. PHP_EOL;
    }
}
