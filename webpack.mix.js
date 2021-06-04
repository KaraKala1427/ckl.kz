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
    // .js('resources/js/core/jquery.min.js', 'public/js')
    // .js('resources/js/core/popper.min.js', 'public/js')
    // .js('resources/js/core/bootstrap.min.js', 'public/js')
    // .js('resources/js/plugins/perfect-scrollbar.jquery.min.js', 'public/js')
    // .js('resources/js/plugins/bootstrap-notify.js', 'public/js')
    // .js('resources/js/black-dashboard.min.js', 'public/js')
    // .js('resources/js/dopTOP.js', 'public/js')
    // .js('resources/js/popper.js', 'public/js')
    // .js('resources/js/bootstrap.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .copy('resources/sass/vendor/black-dashboard.min.css', 'public/css')
    .copy('resources/sass/vendor/nucleo-icons.css', 'public/css');
