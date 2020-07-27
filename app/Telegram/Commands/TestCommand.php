<?php

namespace App\Telegram\Commands;

use Illuminate\Support\Facades\Log;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

/**
 * Class HelpCommand.
 */
class TestCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'test';

    /**
     * @var string Command Description
     */
    protected $description = 'Test command, Get a list of commands';

    /**
     * {@inheritdoc}
     */
    public function handle($arguments)
    {
        /** БОТ набирает в чате */
        $this->replyWithChatAction([
            'action' => Actions::TYPING,
        ]);


        $keyboard = [
            ['7', 'asdfsdaf', '9'],    // первая строка клавиатуры
            ['4', '5', '6'],    // вторая строка клавиатуры
            ['1', '2', '3'],    // третья строка клавиатуры
            ['0']               // 4ая строка клавиатуры
        ];

        $telegram_user = Telegram::getWebhookUpdates()['message'];

        $reply_markup = Telegram::replyKeyboardMarkup([
            'keyboard' => $keyboard,    // массив кнопок
            'resize_keyboard' => true,  // не меняется по вертикали для оптимальной подгонки
            'one_time_keyboard' => true // исчезает после использования
        ]);

        $response = Telegram::sendMessage([
            'chat_id' => $telegram_user['from']['id'],     // номер чата
            'text' => 'Hello World',    // текст
            'reply_markup' => $reply_markup // json сериализованный объект для клавиатуры
        ]);

        $messageId = $response->getMessageId(); // id последнего отправленного сообщения
        Log::notice($messageId);
    }
}
