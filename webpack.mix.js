const mix = require('laravel-mix');

mix.setPublicPath('assets');
mix.setResourceRoot('./');

mix.sass('src/css/style.scss', 'assets/css/style.css');