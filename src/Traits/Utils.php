<?php

namespace Gerfey\BattleNet\Traits;

use function GuzzleHttp\Psr7\parse_query;

trait Utils
{
    private static $replaceTable = [
        ['à', 'ê', 'é', 'ü', '-'],
        ['a', 'e', 'e', 'u', ''],
    ];

    private static $regexTable = [
        ['![^\-\pL\pN\s]+!u', '![\-\s]+!u'],
        ['', '-'],
    ];

    /**
     * @param string $name
     * @return string
     */
    protected function nameToSlug(string $name): string
    {
        $slug = mb_strtolower($name, 'UTF-8');
        return trim((string)$slug);
    }

    /**
     * @param string $name
     * @return string
     */
    protected function realmNameToSlug(string $name): string
    {
        $name = mb_strtolower($name, 'UTF-8');
        $slug = str_replace(static::$replaceTable[0], static::$replaceTable[1], $name);
        $slug = preg_replace(static::$regexTable[0], static::$regexTable[1], $slug);
        return trim((string)$slug, '-');
    }

    /**
     * @param string $url
     * @return array
     */
    protected function parseBlizzardApiReference(string $url): array
    {
        $url = parse_url($url);

        if (!empty($url['query'])) {
            $currentNamespace = explode('-', parse_query($url['query'])['namespace']);
        }

        return [
            'url' => trim((string)$url['scheme'] . '://' . $url['host'] . $url['path']),
            'namespace' => (!empty($currentNamespace)) ? $currentNamespace[0] : '',
        ];
    }
}