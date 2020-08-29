<?php

namespace App\Telegram\Commands;

use App\DTOs\TelegramCommandDTO;
use App\Services\Telegram\TelegramService;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

/**
 * Class HelpCommand.
 */
class SettingsCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'settings';

    /**
     * @var string Command Description
     */
    protected $description = 'Get settings';
    /**
     * @var TelegramService
     */
    private $service;

    /**
     * @var TelegramCommandDTO $telegramCommand
     */
    public function handle($telegramCommand)
    {
        $this->service = app(TelegramService::class);
        $telegramMessage = $telegramCommand->toArray()[TelegramCommandDTO::TELEGRAM_MESSAGE_DTO]->toArray();

        $keyboard = [
            [__('telegram.set_group')],
            [__('telegram.menu')],
        ];

        $reply_markup = Telegram::replyKeyboardMarkup([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => false,
        ]);

        Telegram::sendMessage([
            'chat_id' => $telegramMessage['from']['id'],
            'text' => __('telegram.settings'),
            'reply_markup' => $reply_markup,
        ]);
    }
}
