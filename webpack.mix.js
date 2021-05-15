const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/assets/js').version().sourceMaps(true, 'source-map');

mix.css('resources/css/highlightjs.css', 'public/assets/css')
    .postCss('resources/css/app.css', 'public/assets/css', [
        require('tailwindcss')
    ]).version();
