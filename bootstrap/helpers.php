<?php

if (! function_exists('route')) {
    /**
     * Generate the URL to a named route.
     *
     * @param  array|string  $name
     * @param  mixed  $parameters
     * @param  bool  $absolute
     * @return string
     */
    function route($name, $parameters = [], $absolute = true)
    {
        $locale = App::getLocale();

        $parameters = array_merge([
            'locale' => $locale,
        ], $parameters);

        return app('url')->route($name, $parameters, $absolute);
    }
}
