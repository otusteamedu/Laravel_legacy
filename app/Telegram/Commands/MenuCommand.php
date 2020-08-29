<?php

namespace App\Telegram\Commands;

use App\DTOs\TelegramCommandDTO;
use App\Services\Telegram\TelegramService;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

/**
 * Class HelpCommand.
 */
class MenuCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'menu';

    /**
     * @var string Command Description
     */
    protected $description = 'Get menu';
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
            [__('telegram.schedule')],
            [__('telegram.settings')],
        ];

        $reply_markup = Telegram::replyKeyboardMarkup([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => false,
        ]);

        Telegram::sendMessage([
            'chat_id' => $telegramMessage['from']['id'],
            'text' => __('telegram.menu_start'),
            'reply_markup' => $reply_markup,
        ]);
    }
}
