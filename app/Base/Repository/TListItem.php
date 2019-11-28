<?php


namespace App\Base\Repository;


trait TListItem
{
    public function getListId(): int {
        return $this->id;
    }

    public function getListTitle() {
        return $this->name;
    }
}
