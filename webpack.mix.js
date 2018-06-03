const mix = require('laravel-mix');

mix.setPublicPath('assets');
mix.setResourceRoot('./');

mix.sass('src/css/style.scss', 'assets/css/style.css');
mix.js('src/js/app.js', 'assets/js/app.js');