<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class UpdateGrammarJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $page_id;
    protected $user_id;
    public function __construct($page_id,$user_id)
    {
        $this->page_id=$page_id;
        $this->user_id=$user_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $message="Страниуа грамматика с id={$this->page_id} отредактирована пользователем c id={$this->user_id}";
        Log::info($message);
        echo $message;
    }
}
