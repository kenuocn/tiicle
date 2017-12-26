let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
    .copyDirectory('resources/assets/editor/js', 'public/js')
    .copyDirectory('resources/assets/editor/css', 'public/css')
    .copyDirectory('resources/assets/images', 'public/images')
    mix.js('resources/assets/js/vendor/simplemde.min.js', 'public/js/editor.js')
    mix.sass('resources/assets/sass/vendor/simplemde.min.scss', 'public/css/editor.css');

