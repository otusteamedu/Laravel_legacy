<?php

namespace App\Telegram\Commands;

use App\DTOs\TelegramCommandDTO;
use App\Models\TelegramUser;
use App\Services\Telegram\Statuses\TelegramUserStatus;
use App\Services\Telegram\TelegramService;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

/**
 * Class HelpCommand.
 */
class ScheduleCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'schedule';

    /**
     * @var string Command Description
     */
    protected $description = 'Schedule';
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
        /** @var TelegramUser $telegramUser */
        $telegramUser = $telegramCommand->toArray()[TelegramCommandDTO::TELEGRAM_USER];
        $telegramUserStatus = app(TelegramUserStatus::class);

        if (!$telegramUser->default_group) {
            app(SetDefaultGroupCommand::class)->handle($telegramCommand);
            return;
        }

        $telegramUserStatus->setStatus($telegramUser, TelegramUserStatus::SET_SCHEDULE_DATE);

        $keyboard = [
            [__('telegram.menu')],
        ];

        $reply_markup = Telegram::replyKeyboardMarkup([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => false,
        ]);

        Telegram::sendMessage([
            'chat_id' => $telegramMessage['from']['id'],
            'text' => __('telegram.set_date'),
            'reply_markup' => $reply_markup,
        ]);
    }
}
