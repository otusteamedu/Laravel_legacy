<?php

namespace App\DTOs;

use Carbon\Carbon;

/**
 * Class PostDTO
 * @package App\DTOs
 */
class PostDTO implements DTOInterface
{
    const TITLE = 'title';
    const BODY = 'body';
    const USER_ID = 'user_id';
    const PUBLISHED_AT  = 'published_at';
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $body;
    /**
     * @var int
     */
    private $userId;
    /**
     * @var Carbon
     */
    private $publishedAt;

    /**
     * PostDTO constructor.
     * @param string $title
     * @param string $body
     * @param int $userId
     * @param Carbon|null $publishedAt
     */
    private function __construct(string $title, string $body, int $userId, ?Carbon $publishedAt)
    {

        $this->title = $title;
        $this->body = $body;
        $this->userId = $userId;
        $this->publishedAt = $publishedAt;
    }

    /**
     * @param array $data
     * @return DTOInterface
     */
    public static function fromArray(array $data): DTOInterface
    {
        return new static(
            $data[static::TITLE],
            $data[static::BODY],
            $data[static::USER_ID],
            $data[static::PUBLISHED_AT] ?? null
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            static::TITLE => $this->title,
            static::BODY => $this->body,
            static::USER_ID => $this->userId,
            static::PUBLISHED_AT => $this->publishedAt,
        ];
    }
}
