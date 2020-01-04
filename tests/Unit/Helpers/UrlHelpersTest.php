<?php

namespace Tests\Unit\Helpers;

use App\Helpers\UrlHelpers;
use PHPUnit\Framework\TestCase;

class UrlHelpersTest extends TestCase
{

    /**
     * @dataProvider urlsProvider
     */
    public function testNormalizeRepositryUrl($url, $expectedNormalizedUrl)
    {
        $normalizedUrl = UrlHelpers::normalizeRepositryUrl($url);
        $this->assertEquals($expectedNormalizedUrl, $normalizedUrl);
    }

    public function urlsProvider()
    {
        return [
            ['https://example.com/org/repo', 'example.com/org/repo'],
            ['https://example.com:1234/org/repo', 'example.com/org/repo'],
            ['https://user:pass@example.com:1234/org/repo', 'example.com/org/repo'],
            ['git@github.com:phptrack/phptrack.io.git', 'github.com/phptrack/phptrack.io'],
            ['ssh://user@server/project.git', 'server/project'],
            ['example.com/org/repo', 'example.com/org/repo'],
        ];
    }
}
