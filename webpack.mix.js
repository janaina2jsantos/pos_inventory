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

mix.js('resources/js/app.js', 'public/js')
    .copyDirectory('resources/js/pages/', 'public/js/pages/')
    .copyDirectory('resources/dist/assets/js', 'public/dist/assets/js')
    .copyDirectory('resources/dist/assets/css', 'public/dist/assets/css')
    .copyDirectory('resources/dist/assets/img', 'public/dist/assets/img')
    .copyDirectory('resources/dist/assets/plugins', 'public/dist/assets/plugins')
    .postCss('resources/css/custom.css', 'public/css')
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss'),
        require('autoprefixer'),
]);
