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

mix.js('resources/js/app/app.js', 'public/js/app')
   .js('resources/js/web/web.js', 'public/js/web')
   .sass('resources/sass/app/app.scss', 'public/css/app')
   .sass('resources/sass/web/web.scss', 'public/css/web');
