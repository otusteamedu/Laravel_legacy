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

mix.webpackConfig({
    module: {
        rules: [
            {
                test: /\.pug$/,
                oneOf: [
                    {
                        resourceQuery: /^\?vue/,
                        use: ['pug-plain-loader']
                    },
                    {
                        use: ['raw-loader', 'pug-plain-loader']
                    }
                ]
            }
        ]
    },
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/manager/js'),
            '@@': path.resolve(__dirname, 'resources/js')
        }
    }
});

mix
    .js('resources/manager/js/app.js', 'public/js/manager')
    .js('resources/js/app.js', 'public/js')
    .sass('resources/manager/sass/app.scss', 'public/css/manager')
    .sass('resources/sass/app.scss', 'public/css');

