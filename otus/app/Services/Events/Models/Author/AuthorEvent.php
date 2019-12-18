<?php

namespace App\Services\Events\Models\Author;

use App\Models\Author;

class AuthorEvent {

    /** @var Author */
    private $author;

    public function __construct(Author $author) {
        $this->author = $author;
    }

    /**
     * @return Author
     */
    public function getAuthor(): Author {
        return $this->author;
    }
}
