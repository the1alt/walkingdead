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
    .combine([
        'vendor/bower_dl/jquery/dist/jquery.min.js',
        'vendor/bower_dl/angular/angular.min.js',
        'vendor/bower_dl/moment/moment.js',
    ], 'public/dist/js/bundle.js')
    .sass('resources/assets/sass/app.scss', 'public/css');
