<?php

namespace App\Jobs;

use App\Models\Film;
use App\Services\Films\FilmsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
//use Illuminate\Queue\SerializesModels;

/**
 * Подготовка статьи к публикации
 *
 * Class PrepareJob
 * @package App\Jobs
 */
class FilmPrepareJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    protected $message;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Film $film)
    {
        $this->message = $film;
        \Log::channel('processlog')->info(sprintf('dfdfdf', $this->message));
    }

    /**
     * Execute the job.
     *
     * @param FilmsService $filmsService
     * @return void
     */
    public function handle(FilmsService $filmsService)
    {
        echo 'Prepare...';
        $filmsService->publishFilm($this->message);
        \Log::channel('processlog')->info(sprintf('Фильм[id-%d] подготовлен к публикации', $this->message->id));
    }
}
