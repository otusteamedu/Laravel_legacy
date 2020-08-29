<?php

namespace App\DTOs;

/**
 * Class TelegramMessageDTO
 * @package App\DTOs
 */
class TelegramMessageDTO implements DTOInterface
{
    const MESSAGE_ID = 'message_id';
    const FROM = 'from';
    const CHAT = 'chat';
    const DATE = 'date';
    const TEXT = 'text';
    const ID = 'id';
    const IS_BOT = 'is_bot';
    const FIRST_NAME = 'first_name';
    const LAST_NAME = 'last_name';
    const USERNAME = 'username';
    const LANGUAGE_CODE = 'language_code';
    const TYPE = 'type';

    /**
     * @var int
     */
    private $message_id;
    /**
     * @var array
     */
    private $from;
    /**
     * @var array
     */
    private $chat;
    /**
     * @var int
     */
    private $date;
    /**
     * @var string
     */
    private $text;

    /**
     * IdDTO constructor.
     * @param int $message_id
     * @param array $from
     * @param array $chat
     * @param int $date
     * @param string $text
     */
    private function __construct(int $message_id, array $from, array $chat, int $date, string $text)
    {
        $this->message_id = $message_id;
        $this->setFrom(
            $from[static::ID],
            $from[static::IS_BOT],
            $from[static::FIRST_NAME],
            $from[static::LAST_NAME],
            $from[static::USERNAME],
            $from[static::LANGUAGE_CODE]
        );
        $this->setChat(
            $chat[static::ID],
            $chat[static::FIRST_NAME],
            $chat[static::LAST_NAME],
            $chat[static::USERNAME],
            $chat[static::TYPE]
        );
        $this->date = $date;
        $this->text = $text;
    }

    /**
     * @param int $id
     * @param bool $is_bot
     * @param string|null $first_name
     * @param string|null $last_name
     * @param string|null $username
     * @param string|null $language_code
     */
    private function setFrom(
        int $id,
        bool $is_bot,
        string $first_name = null,
        string $last_name = null,
        string $username = null,
        string $language_code = null
    ): void {
        $this->from[static::ID] = $id;
        $this->from[static::IS_BOT] = $is_bot;
        $this->from[static::FIRST_NAME] = $first_name;
        $this->from[static::LAST_NAME] = $last_name;
        $this->from[static::USERNAME] = $username;
        $this->from[static::LANGUAGE_CODE] = $language_code;
    }

    /**
     * @param int $id
     * @param string|null $first_name
     * @param string|null $last_name
     * @param string|null $username
     * @param string|null $type
     */
    private function setChat(
        int $id,
        string $first_name = null,
        string $last_name = null,
        string $username = null,
        string $type = null
    ): void {
        $this->chat[static::ID] = $id;
        $this->chat[static::FIRST_NAME] = $first_name;
        $this->chat[static::LAST_NAME] = $last_name;
        $this->chat[static::USERNAME] = $username;
        $this->chat[static::TYPE] = $type;
    }

    /**
     * @param array $data
     * @return DTOInterface
     */
    public static function fromArray(array $data): DTOInterface
    {
        return new static(
            $data[static::MESSAGE_ID],
            $data[static::FROM],
            $data[static::CHAT],
            $data[static::DATE],
            $data[static::TEXT]
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            static::MESSAGE_ID => $this->message_id,
            static::FROM => $this->from,
            static::CHAT => $this->chat,
            static::DATE => $this->date,
            static::TEXT => $this->text,
        ];
    }
}
