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
    .js('resources/js/admin.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/admin.scss', 'public/css')
    .copy('resources/css/owl.carousel.min.css', 'public/css/owl.carousel.min.css')
    .copy('resources/css/owl.theme.default.min.css', 'public/css/owl.theme.default.min.css')
    .copy('resources/js/owl.autoplay.js', 'public/js/owl.autoplay.js')
    .copy('resources/js/owl.carousel.min.js', 'public/js/owl.carousel.min.js')
    .copy('resources/css/datapicker.min.css', 'public/css/datapicker.min.css')
    .copy('resources/js/datapicker.min.js', 'public/js/datapicker.min.js')
    .copy('resources/js/datepicker-ru.js', 'public/js/datepicker-ru.js')
    .copyDirectory('resources/css/images', 'public/css/images');
