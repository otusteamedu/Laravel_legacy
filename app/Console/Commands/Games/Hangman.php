<?php

namespace App\Console\Commands\Games;

use App\Services\Commands\Games\Hangman\HangmanService;
use App\Services\Commands\Games\Hangman\Repositories\ConsoleHangmanRepositoryInterface;
use Illuminate\Console\Command;

class Hangman extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'games:hangman {--hidden-word= : Загаданное слово}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Let\'s play a game?';

    /** @var HangmanService */
    protected $hangmanService;

    /**
     * Create a new command instance.
     *
     * @param  HangmanService  $hangmanService
     */
    public function __construct(HangmanService $hangmanService)
    {
        parent::__construct();

        $this->hangmanService = $hangmanService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() :void
    {
        $this->hangmanService->boot($this);
    }
}
