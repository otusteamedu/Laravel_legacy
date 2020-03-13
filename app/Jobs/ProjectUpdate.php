<?php

namespace App\Jobs;

use App\Http\Controllers\Cms\Requests\ProjectUpdateRequest;
use App\Models\Project;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Log;

class ProjectUpdate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $project;
    private $name;

    public function __construct(Project $project,ProjectUpdateRequest $request)
    {
        $this->project = $project->name;
        $this->delay(now()->addMinutes(1));
        $this->name = $request->user()->name;
    }

    public function failed()
    {
        $message = "Проверька очередь обновления проекта";
        Log::info($message);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $message = 'Пользователь ' . $this->name . ' изменил следующий проект - ' . $this->project;
        Log::info($message);
    }
}
