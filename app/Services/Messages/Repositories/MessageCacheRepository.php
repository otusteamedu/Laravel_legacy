<?php


namespace App\Services\Messages\Repositories;


class MessageCacheRepository
{
    const LIST_CACHE_KEY = 'messageList';
    const CACHE_TIME = 60*20;

    private $messageRepository;

    public function __construct(MessageRepositoryInterface $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }


    public function cachingMessageList()
    {
        return \Cache::remember(self::LIST_CACHE_KEY, self::CACHE_TIME, function() {
            return $this->messageRepository->list();
        });
    }

}
