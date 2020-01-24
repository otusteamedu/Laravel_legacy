<?php
/**
 * @copyright Copyright (c) Archvile <info@0x25.ru>
 * @link https://0x25.ru
 */

namespace App\Services\Commands\Games\Hangman\Repositories;


use Illuminate\Console\Command;

class ConsoleHangmanRepository implements ConsoleHangmanRepositoryInterface
{
    /** @var Command */
    protected $command;

    /** @var string */
    const HIDDEN_SYMBOL = '*';

    /** @var int */
    const MAX_STEPS = 5;

    /** @var string */
    public $hiddenWord = 'developer';
    /** @var int */
    public $currentStep = 0;

    public $answers;

    /**
     * @inheritDoc
     */
    public function boot(Command $command)
    {
        $this->command = $command;

        if ($this->command->option('hidden-word')) {
            $this->hiddenWord = $this->command->option('hidden-word');
        }

        $this->answers = [$this->hiddenWord[0], $this->hiddenWord[strlen($this->hiddenWord) - 1]];

        $choice = $this->command->choice(__('Let\'s play a game'), __('First choice'), __('Come on!'));

        if (array_search($choice, __('First choice')) === 0) {
            $this->command->error(__('Let the game begin!'));
            $this->round();
        } else {
            $this->stop();
        }
    }

    public function round()
    {
        if ($this->currentStep === self::MAX_STEPS) {
            $this->stop();
        }

        $this->drawHiddenWord();
        $this->drawGallows();
        $this->askWord();
    }

    public function askWord()
    {
        $word = $this->command->ask(__('Name the entire word or a single letter'));

        if ($word === $this->hiddenWord) {
            $this->win();
        }

        if (strlen($word) === 0) {
            return $this->askWord();
        }

        $letter = str_split($word)[0];
        array_push($this->answers, $letter);

        $word = str_split($this->hiddenWord);

        if (!in_array($letter, $word)) {
            $this->currentStep++;
        }

        return $this->round();
    }

    public function drawHiddenWord()
    {
        $word = str_split($this->hiddenWord);

        foreach ($word as &$letter) {
            if (!in_array($letter, $this->answers)) {
                $letter = self::HIDDEN_SYMBOL;
            }
        }

        $word = implode('', $word);

        if ($word === $this->hiddenWord) {
            $this->win();
        }

        $this->command->line(__('Attempts: ').(self::MAX_STEPS - $this->currentStep));
        $this->command->info(__('Guess the word: ').$word);
    }

    /**
     * @param  null  $step
     */
    public function drawGallows($step = null)
    {
        $this->command->line(base64_decode(__('Gallows-step-'.($step ?? $this->currentStep))));
    }

    public function win()
    {
        $this->command->info(__('Win!!!'));
        die;
    }

    public function stop()
    {
        $this->drawGallows(5);
        $this->command->error(__('Loser :('));
        die;
    }
}