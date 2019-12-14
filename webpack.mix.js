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
//Front
mix.sass('resources/sass/app.scss', 'public/theme/css/bootstrap.css')
   .styles([
    'public/theme/css/bootstrap.css',
    'resources/css/all.css',
], 'public/theme/css/all.css')
    .js('resources/js/app.js', 'public/theme/js/all.js')

    //Admin
    .styles(['resources/css/admin.css',
        'public/theme/css/bootstrap.css',
    ], 'public/theme/css/admin.css')
    .js(['resources/js/admin.js',
        'resources/js/app.js',
    ], 'public/theme/js/admin.js')




 //.sass('resources/sass/app.scss', 'public/theme/css/all.css');
