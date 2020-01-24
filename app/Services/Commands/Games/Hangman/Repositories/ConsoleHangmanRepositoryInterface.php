<?php
/**
 * @copyright Copyright (c) Archvile <info@0x25.ru>
 * @link https://0x25.ru
 */

namespace App\Services\Commands\Games\Hangman\Repositories;

use Illuminate\Console\Command;

interface ConsoleHangmanRepositoryInterface
{
    /**
     * @param  Command  $command
     *
     * @return mixed
     */
    public function boot(Command $command);
}