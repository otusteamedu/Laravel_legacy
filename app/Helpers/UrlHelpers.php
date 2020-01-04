<?php


namespace App\Helpers;


use App\Exceptions\UrlParseException;

class UrlHelpers
{
    /**
     * Returns repository url without http://, without git://, without credentials
     * @param string $respositoryUrl
     * @return string
     * @throws UrlParseException
     */
    public static function normalizeRepositryUrl(string $respositoryUrl): string
    {
        if (strpos($respositoryUrl, '/') === 0) {
            // Do not normalize local urls /home/user/git/path
            return $respositoryUrl;
        }

        $parts = parse_url($respositoryUrl);
        if (empty($parts['host'])) {

            if (strpos($respositoryUrl, '@') !== false) {

                // git@github.com:org/repo

                $atPos = strpos($respositoryUrl, '@');
                $url2 = substr($respositoryUrl, $atPos + 1);
                $parts = explode(':', $url2, 2);
                $parts['host'] = $parts[0];
                if (!empty($parts[1])) {
                    $parts['path'] = '/' . $parts[1];
                }


            } else {

                // github.com/org/repo

                $parts = explode('/', $respositoryUrl, 2);
                $parts['host'] = $parts[0];
                if (!empty($parts[1])) {
                    $parts['path'] = '/' . $parts[1];
                }

            }

        }

        if (empty($parts['host']) || empty($parts['path'])) {
            throw new UrlParseException($respositoryUrl);
        }

        if ($parts['path'] && substr($parts['path'], -4) === '.git') {
            $parts['path'] = substr($parts['path'], 0, -4);
        }

        return $parts['host'] . $parts['path'];
    }

    public static function isValidRepositoryUrl(string $respositoryUrl): bool
    {
        if (!$respositoryUrl) {
            return false;
        }

        try {

            $normalizedUrl = self::normalizeRepositryUrl($respositoryUrl);
            return !empty($normalizedUrl);

        } catch (UrlParseException $e) {

            return false;

        }
    }

    public static function getHref(string $respositoryUrl): ?string
    {
        try {

            $normalizedUrl = self::normalizeRepositryUrl($respositoryUrl);
            return 'https://' . $normalizedUrl;

        } catch (UrlParseException $e) {

            return null;

        }
    }
}
