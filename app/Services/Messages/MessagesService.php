<?php


namespace App\Services\Messages;


use App\Models\Message;
use App\Services\Messages\Repositories\MessageRepositoryInterface;

class MessagesService
{

    private $messageRepository;

    public function __construct(MessageRepositoryInterface $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function showItem($id)
    {
        return $this->messageRepository->find($id);
    }

    public function showMessageList()
    {
        $messageCacheKey = 'messageList';
        return \Cache::remember($messageCacheKey, 60*20, function() {
            return $this->messageRepository->list();
        });

    }

        public function storeMessage($data)
    {
        return $this->messageRepository->createFromArray($data);
    }

    public function updateMessage(Message $message, array $data)
    {
        return $this->messageRepository->updateFromArray($message, $data);
    }

    public function deleteMessage(Message $message)
    {
        return $this->messageRepository->destroyFromObj($message);
    }

}
