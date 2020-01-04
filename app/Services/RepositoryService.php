<?php


namespace App\Services;


use App\Models\Repository;
use App\ValueObjects\RepositoryUrl;

class RepositoryService
{
    public function firstOrCreate(RepositoryUrl $url): Repository
    {
        return Repository::firstOrCreate(
            ['normalized_url' => $url->normalizedUrl()],
            ['url' => $url->url()]
        );
    }
}
