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

/*mix.scripts([
            'resources/js/jquery.js',
            'resources/js/popper.js',
            'resources/js/bootstrap.js',
            //'resources/js/paper-dashboard.js',
            ], 'public/js/app.js')
    .styles([
            'resources/css/bootstrap.css',
            'resources/css/flatly.css',
            ], 'public/css/app.css');*/

/*mix.scripts(['node_modules/jquery/dist/jquery.js',
        'node_modules/popper.js/dist/popper.js',
        'node_modules/bootstrap/dist/js/bootstrap.js',
        'node_modules/admin-lte/dist/js/adminlte.js'], 'public/js/app.js')
.styles(['node_modules/admin-lte/dist/css/adminlte.css',
        'node_modules/admin-lte/dist/css/adminlte.css.map'], 'public/css/app.css');*/

mix.scrips(['node_modules/jquery/dist/jquery.js',
        'node_modules/popper.js/dist/popper.js',
        'node_modules/bootstrap/dist/js/bootstrap.js',
        'node_modules/admin-lte/dist/js/adminlte.js'], 'public/js/app.js')
    .sass('resources/sass/app.scss', 'public/css');
