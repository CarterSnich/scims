const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js")
    .js('resources/js/register-citizen.js', 'public/js')
    .js('resources/js/philhealth-application.js', 'public/js')
    .js('resources/js/pdf-philhealth.js', 'public/js')
    .js('resources/js/print-citizen.js', 'public/js')
    .js('resources/js/print-pension.js', 'public/js')
    .sass("resources/sass/app.scss", "public/css")
    .postCss("resources/css/style.css", "public/css")
    .css("resources/css/dashboard-style.css", "public/css")
    .css("resources/css/administrator-sidebar.css", "public/css")
    .sourceMaps()
    .disableSuccessNotifications()

