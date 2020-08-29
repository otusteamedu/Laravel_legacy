<?php

namespace App\Telegram\Commands;

use App\DTOs\TelegramMessageDTO;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

/**
 * Class HelpCommand.
 */
class ErrorCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'error';

    /**
     * @var string Command Description
     */
    protected $description = 'Error';

    /**
     * @param TelegramMessageDTO|null $telegramMessageDTO
     * @return mixed|void
     */
    public function handle($telegramMessageDTO = null)
    {
        if (!$telegramMessageDTO) {
            return;
        }

        Telegram::sendMessage([
            'chat_id' => $telegramMessageDTO->toArray()[TelegramMessageDTO::FROM][TelegramMessageDTO::ID],
            'text' => __('telegram.error'),
        ]);
    }
}
