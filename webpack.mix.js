const mix = require('laravel-mix')

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
    .sass('resources/sass/app.sass', 'public/css')
    .browserSync({
        notify: false,
        proxy: 'homepage-laradock_nginx_1', // nginx or caddy Docker ip (more on that later)
        host: 'localhost', // your hostname from .hosts
        open: false,
        files: [
            'resources/**/*',
        ]
    })

if (mix.inProduction()) {
    mix.version()
}
