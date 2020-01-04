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

    // Materialize
    .js('node_modules/materialize-css/dist/js/materialize.js', 'public/vendor/materialize/js')
    .sass('node_modules/materialize-css/sass/materialize.scss', 'public/vendor/materialize/css')

    .sass('resources/sass/app.scss', 'public/css')

    // Layouts
    .sass('resources/sass/layouts/main.scss', 'public/css/layouts/')

    // Pages
    .sass('resources/sass/pages/login.scss', 'public/css/pages')

    .sass('resources/sass/pages/master/users/list.scss', 'public/css/pages/master/users')
    .sass('resources/sass/pages/master/users/detail.scss', 'public/css/pages/master/users')
    .sass('resources/sass/pages/master/users/edit.scss', 'public/css/pages/master/users')

    .sass('resources/sass/pages/master/records/list.scss', 'public/css/pages/master/records')
    .sass('resources/sass/pages/master/records/edit.scss', 'public/css/pages/master/records')

    .js('resources/js/pages/master/users/list.js', 'public/js/pages/master/users/')
    .js('resources/js/pages/master/users/detail.js', 'public/js/pages/master/users/')
    .js('resources/js/pages/master/users/edit.js', 'public/js/pages/master/users/')

    .js('resources/js/pages/master/records/create_edit.js', 'public/js/pages/master/records/')
    .js('resources/js/pages/master/records/list.js', 'public/js/pages/master/records/');

if (mix.inProduction()) {
    mix.version();
}
