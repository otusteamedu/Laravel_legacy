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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/jquery-2.0.0.min.js', 'public/js')
    .js('resources/js/bootstrap.bundle.min.js', 'public/js')
    .js('resources/js/script.js', 'public/js')
    .js('resources/js/common.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/bootstrap.scss', 'public/css')
    .sass('resources/sass/responsive.scss', 'public/css')
    .sass('resources/sass/ui.scss', 'public/css')
    .sass('resources/sass/common.scss', 'public/css');
