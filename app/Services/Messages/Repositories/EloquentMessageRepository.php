<?php


namespace App\Services\Messages\Repositories;


use App\Models\Message;

class EloquentMessageRepository implements MessageRepositoryInterface
{

    public function find(int $id)
    {
        return Message::find($id);
    }

    public function list()
    {
        return Message::with( 'advert', 'user')->get();
    }

        public function search(array $filters = [])
    {
        return Message::paginate();
    }

    public function createFromArray(array $data): Message
    {
        $message = new Message();
        $message->create($data);
        return $message;
    }

    public function updateFromArray(Message $message, array $data)
    {
        $message->update($data);
        return $message;
    }

    public function destroyFromObj(Message $message)
    {
        $message->delete();
    }

}
