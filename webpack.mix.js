const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .js('resources/js/planner/script.js', 'public/js/planner')
    .sass('resources/sass/planner/style.scss', 'public/css/planner')

    .js('resources/js/main/script.js', 'public/js/main')
    .sass('resources/sass/main/style.scss', 'public/css/main')
    .version();;
