<?php

namespace App\Telegram\Commands;

use App\DTOs\TelegramCommandDTO;
use App\Models\TelegramUser;
use App\Services\Students\StudentService;
use App\Services\Telegram\Statuses\TelegramUserStatus;
use App\Services\Telegram\TelegramService;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

/**
 * Class HelpCommand.
 */
class GetGroupsCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'set_group';

    /**
     * @var string Command Description
     */
    protected $description = 'Set student group';
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
        $studentService = app(StudentService::class);
        $telegramMessage = $telegramCommand->toArray()[TelegramCommandDTO::TELEGRAM_MESSAGE_DTO]->toArray();
        /** @var TelegramUser $telegramUser */
        $telegramUser = $telegramCommand->toArray()[TelegramCommandDTO::TELEGRAM_USER];
        $telegramUserStatus = app(TelegramUserStatus::class);

        $groups = [];
        if ($student = $studentService->getStudentByUserId($telegramUser->user_id)) {
            if ($groups = array_values($studentService->getStudentGroupsList($student))) {
                $keyboard[] = collect($groups)->map(function (int $groupId): string {
                    return (string)$groupId;
                })->toArray();
            }
        }

        $telegramUserStatus->setStatus($telegramUser, TelegramUserStatus::SET_GROUP);

        $keyboard[] = [__('telegram.menu')];

        $reply_markup = Telegram::replyKeyboardMarkup([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => false,
        ]);

        Telegram::sendMessage([
            'chat_id' => $telegramMessage['from']['id'],
            'text' => $groups ? __('telegram.available_groups') : __('telegram.no_available_groups'),
            'reply_markup' => $reply_markup,
        ]);
    }
}
