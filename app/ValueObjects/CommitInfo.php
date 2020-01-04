<?php


namespace App\ValueObjects;


use Carbon\CarbonImmutable;
use GitWrapper\Exception\GitException;

class CommitInfo
{
    public $hash;
    public $author;
    public $commitDateTime;
    public $summary;

    public function __construct($hash, $author, $commitDateTime, $summary)
    {
        $hash = trim($hash);
        if (strlen($hash) !== 40) {
            throw new GitException('Invalid git commit hash ' . $hash);
        }

        $this->hash = $hash;
        $this->author = trim($author);
        $this->commitDateTime = new CarbonImmutable($commitDateTime);
        $this->summary = trim($summary);
    }
}
