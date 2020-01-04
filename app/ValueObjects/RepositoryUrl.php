<?php


namespace App\ValueObjects;


use App\Exceptions\UrlParseException;
use App\Helpers\UrlHelpers;

class RepositoryUrl
{
    private $url;
    private $normalizedUrl;

    public function __construct(string $url)
    {
        if (!$url) {
            throw new UrlParseException(trans('errors.empty_url'));
        }
        if (!UrlHelpers::isValidRepositoryUrl($url)) {
            throw new UrlParseException(trans('errors.invalid_url', compact('url')));
        }
        $this->url = $url;
        $this->normalizedUrl = UrlHelpers::normalizeRepositryUrl($url);
    }

    public function url(): string
    {
        return $this->url;
    }

    public function normalizedUrl(): string
    {
        return $this->normalizedUrl;
    }

    public function __toString()
    {
        return $this->url;
    }
}
