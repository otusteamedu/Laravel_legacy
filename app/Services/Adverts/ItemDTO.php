<?php


namespace App\Services\Adverts;


class ItemDTO
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
    public $user_id;
    public $messages;


    public static function make($eloquentObject)
    {
        return new self($eloquentObject);
    }

    public function __construct($object)
    {
        $this->id = $object->id;
        $this->title = $object->title;
        $this->price = $object->price;
        $this->content =$object->content;
        $this->img = $object->img;
        $this->created_at = $object->created_at;
        $this->updated_at =$object->updated_at;
        $this->userName = $object->user->name;
        $this->user_id = $object->user_id;
        $this->messages = $object->messages;


    }


}
