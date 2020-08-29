<?php

namespace App\Telegram\Commands;

use App\DTOs\TelegramCommandDTO;
use App\DTOs\TelegramMessageDTO;
use App\Models\Group;
use App\Models\Lesson;
use App\Models\TelegramUser;
use App\Services\Lessons\LessonService;
use App\Services\Telegram\Statuses\TelegramUserStatus;
use App\Services\Telegram\TelegramService;
use Carbon\Carbon;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

/**
 * Class HelpCommand.
 */
class GetScheduleOnDateCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'schedule_date';

    /**
     * @var string Command Description
     */
    protected $description = 'Get schedule on date';
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

        /**
         * Возможность запросить расписание на следующую дату
         */
        $telegramUserStatus = app(TelegramUserStatus::class);
        $telegramUserStatus->setStatus($telegramUser, TelegramUserStatus::SET_SCHEDULE_DATE);

        if (!$telegramUser->default_group) {
            app(SetDefaultGroupCommand::class)->handle($telegramCommand);
        }

        $date = $groupId = $telegramMessage[TelegramMessageDTO::TEXT] . '.' . date('Y');
        $date = Carbon::parse($date);

        $text = $this->prepare($date, $telegramUser->group) .
            "\n---------\n" .
            __('telegram.set_date');

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
            'text' => $text,
            'reply_markup' => $reply_markup,
        ]);
    }

    /**
     * @param Carbon $date
     * @param Group $group
     * @return string
     */
    private function prepare(Carbon $date, Group $group): string
    {
        $lessonService = app(LessonService::class);
        $lessons = $lessonService->getLessonsByDateAndGroup($date, $group)
            ->map(function (Lesson $lesson): string {
                $body = $lesson->occupation->date->format('d.m.Y') . "\n";
                $body .= $lesson->occupation->schedule->interval . "\n";
                $body .= __('scheduler.room') . ': ' . $lesson->occupation->room->number . "\n";
                $body .= $lesson->educationPlan->lessonType->type . "\n";
                $body .= __('scheduler.subject') . ': ' . $lesson->educationPlan->subject->name . "\n";
                $body .= __('scheduler.teacher') . ': ' . $lesson->educationPlan->teacher->fullName . "\n";

                return $body;
            })->implode("\n---------\n");

        return $lessons ? $lessons : __('telegram.no_available_lessons');
    }
}
