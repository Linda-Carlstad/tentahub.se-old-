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

 mix.override((config) => {
    delete config.watchOptions;
});

if( mix.inProduction() )
{
    mix.js('resources/js/app.js', 'public/js')
        .sass('resources/sass/app.scss', 'public/css')
        .vue().version();
}
else
{
    mix.js('resources/js/app.js', 'public/js')
        .sass('resources/sass/app.scss', 'public/css')
        .vue();
}
