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



mix.copy('resources/vue/dist/css', 'public/css')
    .copy('resources/vue/dist/js', 'public/js')
    .copy('resources/vue/dist/img', 'public/img')
    .copy('resources/vue/dist/favicon.ico', 'public/favicon.ico')
    .copy('resources/vue/dist/loader.css', 'public/loader.css')
    .copy('resources/vue/dist/logo.png', 'public/logo.png')
    .copy('resources/vue/dist/firebase-messaging-sw.js', 'public/firebase-messaging-sw.js')
    .copy('resources/vue/dist/index.html', 'resources/views/vue.blade.php')
