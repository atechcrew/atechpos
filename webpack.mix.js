let mix = require('laravel-mix');

mix.js('resources/assets/js/app.js', 'public/js')
    // .sass('resources/assets/sass/app.scss', 'public/css');

mix.babel([
    'resources/assets/theme/app-assets/vendors/js/vendors.min.js',
    'resources/assets/theme/app-assets/js/core/app-menu.js',
    'resources/assets/theme/app-assets/js/core/app.js',
    'resources/assets/theme/app-assets/js/scripts/forms/select/form-select2.js',
    'resources/assets/theme/custom.js'
], 'public/app-assets/js/bundle.js')

mix.styles([
    'resources/assets/theme/app-assets/css/bootstrap.css',
    'resources/assets/theme/app-assets/fonts/feather/style.css',
    'resources/assets/theme/app-assets/fonts/font-awesome/css/font-awesome.css',
    'resources/assets/theme/app-assets/vendors/css/extensions/pace.css',
    'resources/assets/theme/app-assets/css/bootstrap-extended.css',
    'resources/assets/theme/app-assets/css/colors.css',
    'resources/assets/theme/app-assets/css/components.css',
    'resources/assets/theme/app-assets/css/app.css',
    'resources/assets/theme/app-assets/css/core/menu/menu-types/vertical-menu.css',
    'resources/assets/theme/app-assets/css/core/colors/palette-gradient.css',
    'resources/assets/theme/app-assets/vendors/css/forms/selects/select2.css',
    'resources/assets/theme/custom.css'
], 'public/app-assets/css/all.css')

mix.copyDirectory('resources/assets/theme/app-assets/fonts', 'public/app-assets/css/fonts');
mix.copyDirectory('resources/assets/theme/app-assets/images', 'public/app-assets/images');