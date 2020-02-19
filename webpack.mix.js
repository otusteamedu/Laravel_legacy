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
    .sass('resources/sass/home.scss', 'public/css')
    .sass('resources/sass/index.scss', 'public/css')
   .sass('resources/sass/katalog.scss', 'public/css')
    .sass('resources/sass/blank.scss', 'public/css')
    .sass('resources/sass/login.scss', 'public/css')
    .sass('resources/sass/profile.scss', 'public/css')
    .sass('resources/sass/register.scss', 'public/css')
    .sass('resources/sass/admin.create.scss', 'public/css')
    .sass('resources/sass/admin.edit.scss', 'public/css')
    .sass('resources/sass/admin.index.scss', 'public/css')
    .sass('resources/sass/admin.show.scss', 'public/css')
    .js('resources/js/home.js', 'public/js')
   .js('resources/js/index.js', 'public/js')
   .js('resources/js/katalog.js', 'public/js')
   .js('resources/js/login.js', 'public/js')
   .js('resources/js/profile.js', 'public/js')
   .js('resources/js/register.js', 'public/js')
    .js('resources/js/admin.create.js', 'public/js')
    .js('resources/js/admin.edit.js', 'public/js')
    .js('resources/js/admin.index.js', 'public/js')
    .js('resources/js/admin.show.js', 'public/js');
