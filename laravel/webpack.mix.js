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
    .js('resources/js/hamburger.js', 'public/js')
    .sass('resources/sass/app.sass', 'public/css')
    .sass('resources/sass/home.sass', 'public/css')
    .sass('resources/sass/style.sass', 'public/css')
    .sass('resources/sass/about.sass', 'public/css')
    .sass('resources/sass/authorization.sass', 'public/css')
    .sass('resources/sass/contacts.sass', 'public/css')
    .sass('resources/sass/statistic_table.sass', 'public/css')
    .sass('resources/sass/style_result.sass', 'public/css')
    .sass('resources/sass/style_test.sass', 'public/css')
    .sass('resources/sass/tests.sass', 'public/css')
    .sass('resources/sass/user_profile.sass', 'public/css')
    .sass('resources/sass/modal.sass', 'public/css')
