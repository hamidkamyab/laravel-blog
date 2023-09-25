let mix = require('laravel-mix');

mix.styles([
    'resources/admin/css/font-awesome.min.css',
    'resources/admin/css/simple-line-icons.min.css',
    'resources/admin/dist/style.css',
    'resources/admin/dist/style-custom.css',
    // 'resources/admin/dist/bootstrap.min.css',
], 'public/css/admin.css')

mix.scripts([
    'resources/admin/js/libs/jquery.min.js',
    // 'resources/admin/dist/bootstrap.bundle.min.js',
    'resources/admin/js/libs/bootstrap.min.js',
    'resources/admin/js/libs/Chart.min.js',
    'resources/admin/js/app.js',
    // 'resources/admin/js/libs/pace.min.js',
    'resources/admin/js/views/main.js',
], 'public/js/admin.js')

mix.styles([
    'resources/admin/css/dropzone.min.css',
], 'public/css/dropzone.css').scripts([
    'resources/admin/js/dropzone.min.js',
], 'public/js/dropzone.js')

mix.styles([
    'resources/frontend/plugins/bootstrap/bootstrap.min.css',
    'resources/frontend/css/style.css',
    'resources/frontend/plugins/fontawesome/css/all.min.css',
], 'public/css/front.css').scripts([
    'resources/frontend/plugins/jQuery/jquery.min.js',
    'resources/frontend/plugins/bootstrap/bootstrap.min.js',
    'resources/frontend/js/script.js',
    'resources/frontend/plugins/fontawesome/js/all.min.js',
], 'public/js/front.js')