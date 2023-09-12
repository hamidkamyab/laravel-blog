﻿let mix = require('laravel-mix');

mix.styles([
    'resources/admin/css/font-awesome.min.css',
    'resources/admin/css/simple-line-icons.min.css',
    'resources/admin/dist/style.css',
], 'public/css/all.css')

mix.scripts([
    'resources/admin/js/libs/jquery.min.js',
    'resources/admin/js/libs/bootstrap.min.js',
    'resources/admin/js/libs/Chart.min.js',
    'resources/admin/js/app.js',
    // 'resources/admin/js/libs/pace.min.js',
    // 'resources/admin/js/views/main.js',
], 'public/js/all.js')