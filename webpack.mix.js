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
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/index.scss', 'public/css')
    .sass('resources/sass/login.scss', 'public/css')
    .sass('resources/sass/register.scss', 'public/css')
    .sass('resources/sass/home.scss', 'public/css')
    .sass('resources/sass/katalog.scss', 'public/css')
    .sass('resources/sass/admin.index.scss', 'public/css')
    .sass('resources/sass/admin.show.scss', 'public/css')
    .sass('resources/sass/admin.edit.scss', 'public/css')
    .sass('resources/sass/admin.create.scss', 'public/css')
    .copyDirectory('resources/php','public/php');
