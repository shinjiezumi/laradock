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

mix
  .js('resources/js/app.js', 'public/js')
  .js('resources/js/mycolle/common.js', 'public/js/mycolle')
  .js('resources/js/mycolle/home.js', 'public/js/mycolle')
  .js('resources/js/mycolle/settings.js', 'public/js/mycolle')
  .sass('resources/sass/app.scss', 'public/css')
  .version();
