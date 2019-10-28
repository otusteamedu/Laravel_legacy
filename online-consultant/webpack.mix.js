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

mix.browserSync({
    proxy: process.env.MIX_BROWSERSYNC_PROXY_URL,
    https: process.env.MIX_BROWSERSYNC_HTTPS
});

mix.js('resources/js/admin/admin.js', 'public/js/admin')
   .js('resources/js/admin/bootstrap.js', 'public/js/admin')
   .js('resources/js/web/web.js', 'public/js/web')
   .js('resources/js/web/bootstrap.js', 'public/js/web');

mix.sass('resources/sass/admin/admin.scss', 'public/css/admin')
   .sass('resources/sass/web/web.scss', 'public/css/web');

mix.copyDirectory('resources/img', 'public/img');
mix.copyDirectory('resources/plugins', 'public/plugins');
