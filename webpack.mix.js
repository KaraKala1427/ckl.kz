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
    .js('node_modules/popper.js/dist/popper.js', 'public/js').sourceMaps()
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]).postCss('resources/css/front.css', 'public/css', [
    //
]);
mix.autoload({
    'jquery': ['$', 'window.jQuery', "jQuery", "window.$", "jquery", "window.jquery"],
    'popper.js/dist/umd/popper.js': ['Popper', 'window.Popper']
});
