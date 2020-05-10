<?php

namespace App\Job\Files;

use App\Models\News;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class FilesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $news;

    public function __construct(
        News $news
    ) {
        $this->news = $news;
    }

    public function handle()
    {
        Log::info('File save');
        Log::info($this->news->title);

    }

    public function failed()
    {
        throw new \Exception("FILE don't save");
    }
}
