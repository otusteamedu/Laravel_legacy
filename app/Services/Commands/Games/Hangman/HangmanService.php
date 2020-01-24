<?php
/**
 * @copyright Copyright (c) Archvile <info@0x25.ru>
 * @link https://0x25.ru
 */

namespace App\Services\Commands\Games\Hangman;

use App\Services\Commands\Games\Hangman\Repositories\ConsoleHangmanRepositoryInterface;
use Illuminate\Console\Command;

class HangmanService
{
    /** @var ConsoleHangmanRepositoryInterface  */
    protected $consoleHangmanRepository;

    public function __construct(ConsoleHangmanRepositoryInterface $consoleHangmanRepository)
    {
        $this->consoleHangmanRepository = $consoleHangmanRepository;
    }

    /**
     * @param  Command  $command
     */
    public function boot(Command $command)
    {
        $this->consoleHangmanRepository->boot($command);
    }

}