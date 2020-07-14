<?php


namespace App\Services\Adverts;


class ItemDto
{

    public $items;
    public $id;
    public $title;
    public $price;
    public $content;
    public $img;
    public $created_at;
    public $updated_at;
    public $userName;
    public $userId;
    public $messages;


    public static function make($data)
    {
        return new self($data);
    }

    public function __construct($data)
    {
        $this->id = $data->id;
        $this->title = $data->title;
        $this->price = $data->price;
        $this->content = $data->content;
        $this->img = $data->img;
        $this->created_at = $data->created_at;
        $this->updated_at = $data->updated_at;
        $this->userName = $data->user->name;
        $this->userId = $data->user_id;
        $this->messages = $data->messages;


    }


}
