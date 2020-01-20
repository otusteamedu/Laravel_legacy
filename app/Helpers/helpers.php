<?php
/**
 * @copyright Copyright (c) Archvile <info@0x25.ru>
 * @link https://0x25.ru
 */

if (!function_exists('localize_route')) {
    /**
     * Generate the URL to a named route.
     *
     * @param  array|string  $name
     * @param  mixed  $parameters
     * @param  bool  $absolute
     *
     * @return string
     */
    function localize_route($name, $parameters = [], $absolute = true)
    {

        if (!is_array($parameters)) {
            $parameters = [$parameters];
        }

        if (!isset($parameters['locale'])) {
            $parameters['locale'] = app()->getLocale();
        }

        return route($name, $parameters, $absolute);
    }
}
