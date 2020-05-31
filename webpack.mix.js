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

mix.js(['resources/js/app.js'], 'public/js')
    .extract(['bootstrap','popper.js'])
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();

mix.copy('resources/css/signin.css', 'public/css/signin.css')
    .copy('resources/css/dashboard.css', 'public/css/dashboard.css');
