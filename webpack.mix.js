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
mix
    .js([
            'resources/assets/backend/backend.js',
        ],
        'public/backend/backend.js'
    )
    .sass('resources/assets/backend/backend.scss', 'public/backend/backend.css').options({
        autoprefixer: {
            options: {
                
            }
        },
        processCssUrls: false
    })

    // .combine([
    //     'resources/assets/backend/themes/limitless/global_assets/css/icons/icomoon/styles.css',
    //     // 'resources/assets/backend/themes/limitless/global_assets/css/icons/flaticon/styles.css',
    //     // 'resources/assets/backend/themes/limitless/global_assets/css/icons/flaticon2/styles.css',
    //     'resources/assets/backend/themes/limitless/css/bootstrap.min.css',
    //     'resources/assets/backend/themes/limitless/css/bootstrap_limitless.min.css',
    //     'resources/assets/backend/themes/limitless/css/layout.min.css',
    //     'resources/assets/backend/themes/limitless/css/components.min.css',
    //     'resources/assets/backend/themes/limitless/css/colors.min.css',
    //     'node_modules/animate.css/animate.css',
    //     'node_modules/bootstrap-sweetalert/dist/sweetalert.css',
    //     'node_modules/intro.js/minified/introjs.min.css',
    //     'node_modules/orgchart/dist/css/jquery.orgchart.min.css',
    //     'node_modules/jstree/dist/themes/default/style.min.css',
    //     'node_modules/webui-popover/dist/jquery.webui-popover.css',
    //     'node_modules/codemirror/lib/codemirror.css',
    //     'node_modules/flag-icon-css/css/flag-icon.min.css',
    //     'node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
    //     'resources/assets/backend/extra-aslamise/css/languages/languages.min.css',
    //     'resources/assets/backend/extra-aslamise/plugins/flipclock/flipclock.css',
    //     'resources/assets/backend/extra-aslamise/plugins/bootstraptoggle/bootstrap-toggle.min.css',
    //     'resources/assets/backend/themes/limitless/css/extra.css'
    // ], 'public/backend/backend.css')
    .version();






mix.js([
            'resources/assets/frontend/frontend.js',
        ],
        'public/frontend'
    )
    .sass('resources/assets/frontend/frontend.scss', 'public/raw/frontend.css')
    .combine([
        'public/raw/frontend.css',
        'node_modules/animate.css/animate.css',
        'node_modules/intro.js/minified/introjs.min.css',
        'resources/assets/frontend/frontend-v2/css/stack-interface.css',
        'resources/assets/frontend/frontend-v2/css/theme.css',
        'resources/assets/frontend/frontend-v2/css/custom.css',
    ], 'public/frontend/frontend.css')
    .version();



// mix.copy('resources/assets/files', 'public/files');
// mix.copy('resources/assets/files/favicons', 'public');
// mix.copy('resources/assets/backend/themes/limitless/global_assets/css/icons/icomoon/fonts', 'public/backend/fonts');
// // mix.copy('resources/assets/backend/themes/limitless/global_assets/css/icons/flaticon/fonts', 'public/backend/fonts/flaticon');
// // mix.copy('resources/assets/backend/themes/limitless/global_assets/css/icons/flaticon2/fonts', 'public/backend/fonts/flaticon2');
// mix.copy('resources/assets/backend/themes/limitless/global_assets/css/icons/feather/icons', 'public/backend/icons/feather');
// mix.copy('resources/assets/backend/themes/limitless/global_assets/images', 'public/global_assets/images');
// mix.copy('resources/assets/backend/themes/limitless/global_assets/css/icons', 'public/global_assets/css/icons');
// mix.copy('resources/assets/backend/extra-aslamise/css/languages/languages.png', 'public/img/languages.png');
// mix.copy('node_modules/jstree/dist/themes/default/32px.png', 'public/backend/32px.png');
// mix.copy('node_modules/jstree/dist/themes/default/40px.png', 'public/backend/40px.png');
// mix.copy('node_modules/jstree/dist/themes/default/throbber.gif', 'public/backend/throbber.gif');