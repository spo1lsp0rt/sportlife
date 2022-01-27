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

mix.js('resources/js/app.js', 'public/js').version()
    .sass('resources/sass/app.sass', 'public/css').version()
    .sass('resources/sass/home.sass', 'public/css').version()
    .sass('resources/sass/style.sass', 'public/css').version()
    .sass('resources/sass/about.sass', 'public/css').version()
    .sass('resources/sass/authorization.sass', 'public/css').version()
    .sass('resources/sass/testform.sass', 'public/css').version()
    .sass('resources/sass/contacts.sass', 'public/css').version()
    .sass('resources/sass/statistic_table.sass', 'public/css').version()
    .sass('resources/sass/style_result.sass', 'public/css').version()
    .sass('resources/sass/style_test.sass', 'public/css').version()
    .sass('resources/sass/tests.sass', 'public/css').version()
    .sass('resources/sass/user_profile.sass', 'public/css').version();
//mix.js('resources/js/bootstrap.min.js', 'public/js')
