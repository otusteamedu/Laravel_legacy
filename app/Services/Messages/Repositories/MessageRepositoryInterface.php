<?php


namespace App\Services\Messages\Repositories;


use App\Models\Message;

interface MessageRepositoryInterface
{

    public function find(int $id);

    public function list();

    public function search(array $filters = []);

    public function createFromArray(array $data): Message;

    public function updateFromArray(Message $message, array $data );

    public function destroyFromObj(Message $message);

}
