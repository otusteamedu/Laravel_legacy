<?php


namespace App\Services\Blog\Author\Data;


use App\Models\File;
use App\Services\DataTransfer\DataTransferInterface;

class AuthorDataTransfer implements DataTransferInterface
{
    /** @var string */
    public $name;

    /** @var File */
    public $photo;
}
