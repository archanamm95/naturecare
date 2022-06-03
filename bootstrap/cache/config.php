<?php return array (
  'LaraLegals' => 
  array (
  ),
  'Laralegal' => 
  array (
  ),
  'Laralegals' => 
  array (
  ),
  'app' => 
  array (
    'name' => 'NATURECARE',
    'env' => 'local',
    'debug' => true,
    'url' => 'http://naturecare.demo',
    'asset_url' => NULL,
    'site_url' => NULL,
    'timezone' => 'Asia/Kuala_Lumpur',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'key' => 'base64:xJMa/pNKCOdR/9vZGz0s1ZgP/PS0dbOMUiBUWeS4jT8=',
    'cipher' => 'AES-256-CBC',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Validation\\ValidationServiceProvider',
      20 => 'Illuminate\\View\\ViewServiceProvider',
      21 => 'App\\Providers\\AppServiceProvider',
      22 => 'App\\Providers\\AuthServiceProvider',
      23 => 'App\\Providers\\EventServiceProvider',
      24 => 'App\\Providers\\RouteServiceProvider',
      25 => 'DougSisk\\CountryState\\CountryStateServiceProvider',
      26 => 'Intervention\\Image\\ImageServiceProvider',
      27 => 'Laracasts\\Flash\\FlashServiceProvider',
      28 => 'Vsch\\TranslationManager\\ManagerServiceProvider',
      29 => 'Vsch\\TranslationManager\\TranslationServiceProvider',
      30 => 'Torann\\Currency\\CurrencyServiceProvider',
      31 => 'Yajra\\DataTables\\DataTablesServiceProvider',
      32 => 'Yajra\\DataTables\\ButtonsServiceProvider',
      33 => 'App\\Providers\\MailConfigServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Arr' => 'Illuminate\\Support\\Arr',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'Str' => 'Illuminate\\Support\\Str',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Form' => 'Collective\\Html\\FormFacade',
      'Html' => 'Collective\\Html\\HtmlFacade',
      'Input' => 'Illuminate\\Support\\Facades\\Input',
      'Image' => 'Intervention\\Image\\Facades\\Image',
      'Flash' => 'Laracasts\\Flash\\Flash',
      'Currency' => 'Torann\\Currency\\Facades\\Currency',
      'Carbon' => 'Carbon\\Carbon',
      'Datatables' => 'Yajra\\Datatables\\Datatables',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'api' => 
      array (
        'driver' => 'token',
        'provider' => 'users',
        'hash' => false,
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\User',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
      ),
    ),
  ),
  'backup' => 
  array (
    'backup' => 
    array (
      'name' => '',
      'source' => 
      array (
        'files' => 
        array (
          'include' => 
          array (
            0 => '/var/www/html/naturecare',
          ),
          'exclude' => 
          array (
            0 => '/var/www/html/naturecare/vendor',
            1 => '/var/www/html/naturecare/node_modules',
          ),
          'followLinks' => false,
        ),
        'databases' => 
        array (
          0 => 'mysql',
        ),
      ),
      'database_dump_compressor' => NULL,
      'destination' => 
      array (
        'filename_prefix' => '',
        'disks' => 
        array (
          0 => 'google',
          1 => 'local',
        ),
      ),
      'temporary_directory' => '/var/www/html/naturecare/storage/app/backup-temp',
    ),
    'notifications' => 
    array (
      'notifications' => 
      array (
      ),
      'notifiable' => 'Spatie\\Backup\\Notifications\\Notifiable',
      'mail' => 
      array (
        'to' => 'shilpa@bpract.com',
      ),
      'slack' => 
      array (
        'webhook_url' => '',
        'channel' => NULL,
        'username' => NULL,
        'icon' => NULL,
      ),
    ),
    'monitorBackups' => 
    array (
      0 => 
      array (
        'name' => 'NATURECARE',
        'disks' => 
        array (
          0 => 'local',
        ),
        'newestBackupsShouldNotBeOlderThanDays' => 1,
        'storageUsedMayNotBeHigherThanMegabytes' => 5000,
      ),
    ),
    'cleanup' => 
    array (
      'strategy' => 'Spatie\\Backup\\Tasks\\Cleanup\\Strategies\\DefaultStrategy',
      'defaultStrategy' => 
      array (
        'keepAllBackupsForDays' => 7,
        'keepDailyBackupsForDays' => 16,
        'keepWeeklyBackupsForWeeks' => 8,
        'keepMonthlyBackupsForMonths' => 4,
        'keepYearlyBackupsForYears' => 2,
        'deleteOldestBackupsWhenUsingMoreMegabytesThan' => 5000,
      ),
    ),
  ),
  'broadcasting' => 
  array (
    'default' => 'null',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => NULL,
        'secret' => NULL,
        'app_id' => NULL,
        'options' => 
        array (
          'cluster' => NULL,
          'useTLS' => true,
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => '/var/www/html/naturecare/storage/framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
      ),
      'dynamodb' => 
      array (
        'driver' => 'dynamodb',
        'key' => NULL,
        'secret' => NULL,
        'region' => 'us-east-1',
        'table' => 'cache',
        'endpoint' => NULL,
      ),
    ),
    'prefix' => 'naturecare_cache',
  ),
  'countries' => 
  array (
    'table_name' => 'countries',
  ),
  'countrystate' => 
  array (
    'language' => 'eng',
    'limitCountries' => 
    array (
    ),
    'preloadCountryStates' => 
    array (
      0 => 'US',
    ),
    'routePrefix' => 'country-state',
  ),
  'currency' => 
  array (
    'default' => 'MYR',
    'api_key' => 'd962393d75424c3293bd47303ff9d8b1',
    'driver' => 'database',
    'cache_driver' => NULL,
    'drivers' => 
    array (
      'database' => 
      array (
        'class' => 'Torann\\Currency\\Drivers\\Database',
        'connection' => NULL,
        'table' => 'currencies',
      ),
      'filesystem' => 
      array (
        'class' => 'Torann\\Currency\\Drivers\\Filesystem',
        'disk' => NULL,
        'path' => 'currencies.json',
      ),
    ),
    'formatter' => 'php_intl',
    'formatters' => 
    array (
      'php_intl' => 
      array (
        'class' => 'Torann\\Currency\\Formatters\\PHPIntl',
      ),
    ),
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'url' => NULL,
        'database' => 'naturecare',
        'prefix' => '',
        'foreign_key_constraints' => true,
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'naturecare',
        'username' => 'cloud',
        'password' => 'cloud',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => false,
        'engine' => 'InnoDB ROW_FORMAT=DYNAMIC',
        'options' => 
        array (
        ),
        'dump' => 
        array (
          'dump_binary_path' => '/usr/bin',
        ),
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'naturecare',
        'username' => 'cloud',
        'password' => 'cloud',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'naturecare',
        'username' => 'cloud',
        'password' => 'cloud',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'predis',
      'options' => 
      array (
        'cluster' => 'predis',
        'prefix' => 'naturecare_database_',
      ),
      'default' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => 6379,
        'database' => 0,
      ),
      'cache' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => 6379,
        'database' => 1,
      ),
    ),
  ),
  'datatables' => 
  array (
    'search' => 
    array (
      'smart' => true,
      'multi_term' => true,
      'case_insensitive' => true,
      'use_wildcards' => false,
    ),
    'index_column' => 'DT_Row_Index',
    'engines' => 
    array (
      'eloquent' => 'Yajra\\DataTables\\EloquentDataTable',
      'query' => 'Yajra\\DataTables\\QueryDataTable',
      'collection' => 'Yajra\\DataTables\\CollectionDataTable',
      'resource' => 'Yajra\\DataTables\\ApiResourceDataTable',
    ),
    'builders' => 
    array (
    ),
    'nulls_last_sql' => '%s %s NULLS LAST',
    'error' => NULL,
    'columns' => 
    array (
      'excess' => 
      array (
        0 => 'rn',
        1 => 'row_num',
      ),
      'escape' => '*',
      'raw' => 
      array (
        0 => 'action',
      ),
      'blacklist' => 
      array (
        0 => 'password',
        1 => 'remember_token',
      ),
      'whitelist' => '*',
    ),
    'json' => 
    array (
      'header' => 
      array (
      ),
      'options' => 0,
    ),
  ),
  'datatables-buttons' => 
  array (
    'namespace' => 
    array (
      'base' => 'DataTables',
      'model' => '',
    ),
    'pdf_generator' => 'excel',
    'snappy' => 
    array (
      'options' => 
      array (
        'no-outline' => true,
        'margin-left' => '0',
        'margin-right' => '0',
        'margin-top' => '10mm',
        'margin-bottom' => '10mm',
      ),
      'orientation' => 'landscape',
    ),
    'parameters' => 
    array (
      'dom' => 'Bfrtip',
      'order' => 
      array (
        0 => 
        array (
          0 => 0,
          1 => 'desc',
        ),
      ),
      'buttons' => 
      array (
        0 => 'create',
        1 => 'export',
        2 => 'print',
        3 => 'reset',
        4 => 'reload',
      ),
    ),
    'generator' => 
    array (
      'columns' => 'id,add your columns,created_at,updated_at',
      'buttons' => 'create,export,print,reset,reload',
      'dom' => 'Bfrtip',
    ),
  ),
  'datatables-html' => 
  array (
    'namespace' => 'LaravelDataTables',
    'table' => 
    array (
      'class' => 'table',
      'id' => 'dataTableBuilder',
    ),
    'callback' => 
    array (
      0 => '$',
      1 => '$.',
      2 => 'function',
    ),
    'script' => 'datatables::script',
    'editor' => 'datatables::editor',
  ),
  'debug-server' => 
  array (
    'host' => 'tcp://127.0.0.1:9912',
  ),
  'debugbar' => 
  array (
    'enabled' => false,
    'except' => 
    array (
      0 => 'telescope*',
      1 => 'horizon*',
    ),
    'storage' => 
    array (
      'enabled' => true,
      'driver' => 'file',
      'path' => '/var/www/html/naturecare/storage/debugbar',
      'connection' => NULL,
      'provider' => '',
    ),
    'include_vendors' => true,
    'capture_ajax' => true,
    'add_ajax_timing' => false,
    'error_handler' => false,
    'clockwork' => false,
    'collectors' => 
    array (
      'phpinfo' => true,
      'messages' => true,
      'time' => true,
      'memory' => true,
      'exceptions' => true,
      'log' => true,
      'db' => true,
      'views' => true,
      'route' => true,
      'auth' => true,
      'gate' => true,
      'session' => true,
      'symfony_request' => true,
      'mail' => true,
      'laravel' => false,
      'events' => false,
      'default_request' => false,
      'logs' => false,
      'files' => false,
      'config' => false,
      'cache' => false,
    ),
    'options' => 
    array (
      'auth' => 
      array (
        'show_name' => true,
      ),
      'db' => 
      array (
        'with_params' => true,
        'backtrace' => true,
        'timeline' => false,
        'explain' => 
        array (
          'enabled' => false,
          'types' => 
          array (
            0 => 'SELECT',
          ),
        ),
        'hints' => true,
      ),
      'mail' => 
      array (
        'full_log' => false,
      ),
      'views' => 
      array (
        'data' => false,
      ),
      'route' => 
      array (
        'label' => true,
      ),
      'logs' => 
      array (
        'file' => NULL,
      ),
      'cache' => 
      array (
        'values' => true,
      ),
    ),
    'inject' => true,
    'route_prefix' => '_debugbar',
    'route_domain' => NULL,
    'theme' => 'auto',
    'csp-compatible' => false,
  ),
  'dompdf' => 
  array (
    'show_warnings' => false,
    'orientation' => 'portrait',
    'defines' => 
    array (
      'font_dir' => '/var/www/html/naturecare/storage/fonts/',
      'font_cache' => '/var/www/html/naturecare/storage/fonts/',
      'temp_dir' => '/tmp',
      'chroot' => '/var/www/html/naturecare',
      'enable_font_subsetting' => false,
      'pdf_backend' => 'CPDF',
      'default_media_type' => 'screen',
      'default_paper_size' => 'a4',
      'default_font' => 'serif',
      'dpi' => 96,
      'enable_php' => false,
      'enable_javascript' => true,
      'enable_remote' => true,
      'font_height_ratio' => 1.1,
      'enable_html5_parser' => false,
    ),
  ),
  'embed' => 
  array (
    'google_api_key' => 'YOUR API KEY HERE',
    'providers' => 
    array (
      'youtubePlaylistVideo' => 
      array (
        'name' => 'YouTube Playlist',
        'type' => 'video',
        'website' => 'http://youtube.com',
        'ssl' => true,
        'url' => '^(https?://)?(?:www\\.)?(?:youtu\\.be/|youtube\\.com/watch\\?v=)([0-9a-zA-Z-_]{11})(?:\\S*list=)([0-9a-zA-Z-_]+)',
        'info' => 
        array (
          'id' => '{1}',
          'url' => '{protocol}://youtube.com/watch?v={1}&list={2}',
        ),
        'render' => 
        array (
          'sizeRatio' => 1.77,
          'iframe' => 
          array (
            'src' => '{protocol}://www.youtube.com/embed/{1}?list={2}&rel=0&wmode=transparent',
            'width' => 560,
            'height' => 315,
            'allowfullscreen' => NULL,
            'frameborder' => 0,
            'sandbox' => 'allow-scripts allow-same-origin allow-presentation',
            'layout' => 'responsive',
          ),
        ),
        'data' => NULL,
        'dataCallback' => NULL,
      ),
      'youtubePlaylist' => 
      array (
        'name' => 'YouTube Playlist',
        'type' => 'video',
        'website' => 'http://youtube.com',
        'ssl' => true,
        'url' => 
        array (
          0 => '^(https?://)?(?:www\\.)?youtube\\.com/playlist\\?list=([0-9a-zA-Z-_]+)',
        ),
        'info' => 
        array (
          'id' => '{1}',
          'url' => '{protocol}://youtube.com/playlist?list={1}',
        ),
        'render' => 
        array (
          'sizeRatio' => 1.77,
          'iframe' => 
          array (
            'src' => '{protocol}://www.youtube.com/embed/videoseries?list={1}&rel=0&wmode=transparent',
            'width' => 560,
            'height' => 315,
            'allowfullscreen' => NULL,
            'frameborder' => 0,
            'sandbox' => 'allow-scripts allow-same-origin allow-presentation',
            'layout' => 'responsive',
          ),
        ),
        'data' => NULL,
        'dataCallback' => NULL,
      ),
      'youtube' => 
      array (
        'name' => 'YouTube',
        'type' => 'video',
        'website' => 'http://youtube.com',
        'ssl' => true,
        'url' => 
        array (
          0 => '^(https?://)?(?:www\\.)?youtu\\.be/([0-9a-zA-Z-_]{11})?(?:(?:\\S+)?(?:\\?|&)t=([0-9hm]+s))?(?:\\S+)?',
          1 => '^(https?://)?(?:www\\.)?(?:youtu\\.be/|youtube\\.com/(?:embed/|v/|watch\\?v=|watch\\?.+&v=))((?:\\w|-){11})(?:(?:\\S+)?(?:\\?|&)t=([0-9hm]+s))?(?:\\S+)?$',
        ),
        'timestamp' => '^(?:https?://)?(?:www\\.)?(?:youtu\\.be/|youtube\\.com/)(?:\\S+)?(?:(?:\\S+)?(?:\\?|&)t=(?:([0-9]+)h)?(?:([0-9]+)m)?(?:([0-9]+)s)?)$',
        'timestampParam' => '&start=',
        'info' => 
        array (
          'id' => '{1}',
          'url' => '{protocol}://youtu.be/{1}',
          'dataUrl' => '{protocol}://www.googleapis.com/youtube/v3/videos?part=snippet&id={1}',
          'imageRoot' => '{protocol}://img.youtube.com/vi/{1}/',
        ),
        'render' => 
        array (
          'sizeRatio' => 1.77,
          'iframe' => 
          array (
            'src' => '{protocol}://www.youtube.com/embed/{1}?rel=0&wmode=transparent',
            'width' => 560,
            'height' => 315,
            'allowfullscreen' => NULL,
            'frameborder' => 0,
            'sandbox' => 'allow-scripts allow-same-origin allow-presentation',
            'layout' => 'responsive',
          ),
          'object' => 
          array (
            'attributes' => 
            array (
              'width' => 560,
              'height' => 315,
            ),
            'params' => 
            array (
              'movie' => '{protocol}://youtube.com/v/{1}?version=3&rel=0&wmode=transparent',
              'wMode' => 'transparent',
              'allowFullScreen' => 'true',
              'allowscriptaccess' => 'always',
            ),
            'embed' => 
            array (
              'src' => '{protocol}://youtube.com/v/{1}?version=3&rel=0&wmode=transparent',
              'width' => 560,
              'height' => 315,
              'type' => 'application/x-shockwave-flash',
              'allowFullScreen' => 'true',
              'allowscriptaccess' => 'always',
            ),
          ),
        ),
        'data' => NULL,
        'dataCallback' => 'Cohensive\\Embed\\DataFetcher@fetchYoutube',
      ),
      'liveleak' => 
      array (
        'name' => 'LiveLeak',
        'type' => 'video',
        'website' => 'http://liveleak.com',
        'ssl' => false,
        'url' => '(https?://)?(?:www\\.)?liveleak\\.com/ll_embed\\?f=([0-9a-z]+)',
        'info' => 
        array (
          'id' => '{1}',
          'url' => '{protocol}://liveleak.com/ll_embed?f={1}',
        ),
        'render' => 
        array (
          'sizeRatio' => 1.77,
          'iframe' => 
          array (
            'src' => '{protocol}://liveleak.com/ll_embed?f={1}',
            'width' => 640,
            'height' => 360,
            'sandbox' => 'allow-scripts allow-same-origin allow-presentation',
            'layout' => 'responsive',
          ),
        ),
        'data' => NULL,
        'dataCallback' => NULL,
      ),
      'vimeo' => 
      array (
        'name' => 'Vimeo',
        'type' => 'video',
        'website' => 'http://vimeo.com',
        'ssl' => true,
        'url' => 
        array (
          0 => '(https?://)?(?:www\\.)?vimeo\\.com/([0-9]+)',
          1 => '(https?://)?(?:www\\.)?vimeo\\.com/m/([0-9]+)',
        ),
        'info' => 
        array (
          'id' => '{1}',
          'url' => '{protocol}://vimeo.com/{1}',
          'dataUrl' => '{protocol}://vimeo.com/api/v2/video/{1}.json',
        ),
        'render' => 
        array (
          'sizeRatio' => 1.77,
          'iframe' => 
          array (
            'src' => '{protocol}://player.vimeo.com/video/{1}',
            'width' => 500,
            'height' => 281,
            'allowfullscreen' => NULL,
            'frameborder' => 0,
            'sandbox' => 'allow-scripts allow-same-origin allow-presentation',
            'layout' => 'responsive',
          ),
        ),
        'data' => NULL,
        'dataCallback' => 'Cohensive\\Embed\\DataFetcher@fetchVimeo',
      ),
      'dailymotion' => 
      array (
        'name' => 'Dailymotion',
        'type' => 'video',
        'website' => 'http://dailymotion.com',
        'ssl' => true,
        'url' => '(https?://)?(?:www\\.)?dailymotion\\.com/video/([^_]+)',
        'info' => 
        array (
          'id' => '{1}',
          'url' => '{protocol}://dailymotion.com/video/{1}',
        ),
        'render' => 
        array (
          'sizeRatio' => 1.77,
          'iframe' => 
          array (
            'src' => '{protocol}://www.dailymotion.com/embed/video/{1}',
            'width' => 520,
            'height' => 420,
            'sandbox' => 'allow-scripts allow-same-origin allow-presentation',
            'layout' => 'responsive',
          ),
        ),
        'data' => NULL,
        'dataCallback' => NULL,
      ),
      'gametrailers' => 
      array (
        'name' => 'GameTrailers',
        'type' => 'video',
        'website' => 'http://gametrailers.com',
        'ssl' => false,
        'url' => '^(https?://)?media\\.mtvnservices\\.com/embed/([^"]+:)([0-9a-z-_]+)',
        'info' => 
        array (
          'id' => '{1}{2}',
          'url' => '{protocol}://media.mtvnservices.com/embed/{1}{2}',
        ),
        'render' => 
        array (
          'sizeRatio' => 1.77,
          'iframe' => 
          array (
            'src' => '{protocol}://media.mtvnservices.com/embed/{1}{2}',
            'width' => 560,
            'height' => 315,
            'sandbox' => 'allow-scripts allow-same-origin allow-presentation',
            'layout' => 'responsive',
          ),
        ),
        'data' => NULL,
        'dataCallback' => NULL,
      ),
      'ign' => 
      array (
        'name' => 'IGN',
        'type' => 'video',
        'website' => 'http://ign.com',
        'ssl' => false,
        'url' => '^(https?://)?(?:www\\.)?ign\\.com/videos/([0-9a-zA-Z-_/]+)',
        'info' => 
        array (
          'id' => '{1}',
          'url' => '{protocol}://ign.com/videos/{1}',
        ),
        'render' => 
        array (
          'sizeRatio' => 1.77,
          'iframe' => 
          array (
            'src' => '{protocol}://widgets.ign.com/video/embed/content.html?url={1}',
            'width' => 560,
            'height' => 315,
            'sandbox' => 'allow-scripts allow-same-origin allow-presentation',
            'layout' => 'responsive',
          ),
        ),
        'data' => NULL,
        'dataCallback' => NULL,
      ),
      'vine' => 
      array (
        'name' => 'Vine',
        'type' => 'video',
        'website' => 'http://vine.co',
        'ssl' => true,
        'url' => 
        array (
          0 => '^(https?://)?(?:www\\.)?vine\\.co/v/([0-9a-zA-Z]+)',
        ),
        'info' => 
        array (
          'id' => '{1}',
          'url' => '{protocol}://vine.co/v/{1}',
        ),
        'render' => 
        array (
          'sizeRatio' => 0.864,
          'iframe' => 
          array (
            'src' => '{protocol}://vine.co/v/{1}/embed/postcard',
            'width' => 600,
            'height' => 600,
            'sandbox' => 'allow-scripts allow-same-origin allow-presentation',
            'layout' => 'responsive',
          ),
        ),
        'data' => NULL,
        'dataCallback' => NULL,
      ),
      'coub' => 
      array (
        'name' => 'Coub',
        'type' => 'video',
        'website' => 'http://coub.com',
        'ssl' => true,
        'url' => '(https?://)?(?:www\\.)?coub\\.com/view/([^_]+)',
        'info' => 
        array (
          'id' => '{1}',
          'url' => '{protocol}://coub.com/view/{1}',
        ),
        'render' => 
        array (
          'sizeRatio' => 1.77,
          'iframe' => 
          array (
            'src' => '{protocol}://coub.com/embed/{1}?muted=false&autostart=false&originalSize=false&hideTopBar=false',
            'width' => 640,
            'height' => 360,
            'sandbox' => 'allow-scripts allow-same-origin allow-presentation',
            'layout' => 'responsive',
          ),
        ),
        'data' => NULL,
        'dataCallback' => NULL,
      ),
      'kickstarter' => 
      array (
        'name' => 'Kickstarter',
        'type' => 'video',
        'website' => 'http://kickstarter.com',
        'ssl' => true,
        'url' => 
        array (
          0 => '^(https?://)?(?:www\\.)?kickstarter\\.com/projects/([0-9a-zA-Z-_]+)/([0-9a-zA-Z-_]+)',
        ),
        'info' => 
        array (
          'id' => '{1}',
          'url' => '{protocol}://kickstarter.com/projects/{1}/{2}',
        ),
        'render' => 
        array (
          'sizeRatio' => 1.33,
          'iframe' => 
          array (
            'src' => '{protocol}://kickstarter.com/projects/{1}/{2}/widget/video.html',
            'scrolling' => 'no',
            'width' => 640,
            'height' => 480,
            'sandbox' => 'allow-scripts allow-same-origin allow-presentation',
            'layout' => 'responsive',
          ),
        ),
        'data' => NULL,
        'dataCallback' => NULL,
      ),
      'ustream' => 
      array (
        'name' => 'Ustream',
        'type' => 'video',
        'website' => 'http://ustream.tv',
        'ssl' => true,
        'url' => 
        array (
          0 => '^(https?://)?(?:www\\.)?ustream\\.tv/channel/([0-9]+)',
        ),
        'info' => 
        array (
          'id' => '{1}',
          'url' => '{protocol}://ustream.tv/channel/{1}',
        ),
        'render' => 
        array (
          'sizeRatio' => 1.64,
          'iframe' => 
          array (
            'src' => '{protocol}://ustream.tv/embed/{1}?v3&wmode=direct',
            'scrolling' => 'no',
            'width' => 670,
            'height' => 390,
            'sandbox' => 'allow-scripts allow-same-origin allow-presentation',
            'layout' => 'responsive',
          ),
        ),
        'data' => NULL,
        'dataCallback' => NULL,
      ),
      'ustreamArchive' => 
      array (
        'name' => 'Ustream Recorded',
        'type' => 'video',
        'website' => 'http://ustream.tv',
        'ssl' => true,
        'url' => 
        array (
          0 => '^(https?://)?(?:www\\.)?ustream\\.tv/recorded/([0-9]+)',
        ),
        'info' => 
        array (
          'id' => '{1}',
          'url' => '{protocol}://ustream.tv/recorded/{1}',
        ),
        'render' => 
        array (
          'sizeRatio' => 1.64,
          'iframe' => 
          array (
            'src' => '{protocol}://ustream.tv/embed/recorded/{1}?v3&wmode=direct',
            'scrolling' => 'no',
            'width' => 670,
            'height' => 390,
            'sandbox' => 'allow-scripts allow-same-origin allow-presentation',
            'layout' => 'responsive',
          ),
        ),
        'data' => NULL,
        'dataCallback' => NULL,
      ),
      'twitchArchive' => 
      array (
        'name' => 'Twitch Archive',
        'type' => 'video',
        'website' => 'http://twitch.tv',
        'ssl' => true,
        'url' => 
        array (
          0 => '^(https?://)?(?:www\\.)?twitch\\.tv/([^"]+)/b/([0-9]+)',
        ),
        'info' => 
        array (
          'id' => '{1}',
          'url' => '{protocol}://twitch.tv/{1}/b/{2}',
        ),
        'render' => 
        array (
          'sizeRatio' => 1.64,
          'object' => 
          array (
            'attributes' => 
            array (
              'type' => 'application/x-shockwave-flash',
              'data' => '{protocol}://twitch.tv/widgets/archive_embed_player.swf',
              'wmode' => 'transparent',
              'id' => 'clip_embed_player_flash',
              'width' => 500,
              'height' => 350,
            ),
            'params' => 
            array (
              'wMode' => 'transparent',
              'allowFullScreen' => 'true',
              'allowScriptAccess' => 'always',
              'allowNetworking' => 'all',
              'flashvars' => 'archive_id={2}&channel={1}&hostname=www.twitch.tv&auto_play=false&start_volume=25',
              'movie' => '{protocol}://www.twitch.tv/widgets/archive_embed_player.swf',
            ),
          ),
        ),
        'data' => NULL,
        'dataCallback' => NULL,
      ),
      'twitchArchiveChapter' => 
      array (
        'name' => 'Twitch Archive',
        'type' => 'video',
        'website' => 'http://twitch.tv',
        'ssl' => true,
        'url' => 
        array (
          0 => '^(https?://)?(?:www\\.)?twitch\\.tv/([^"]+)/c/([0-9]+)',
        ),
        'info' => 
        array (
          'id' => '{1}',
          'url' => '{protocol}://twitch.tv/{1}/c/{2}',
        ),
        'render' => 
        array (
          'sizeRatio' => 1.64,
          'object' => 
          array (
            'attributes' => 
            array (
              'type' => 'application/x-shockwave-flash',
              'data' => '{protocol}://twitch.tv/widgets/archive_embed_player.swf',
              'wmode' => 'transparent',
              'id' => 'clip_embed_player_flash',
              'width' => 500,
              'height' => 350,
            ),
            'params' => 
            array (
              'wMode' => 'transparent',
              'allowFullScreen' => 'true',
              'allowScriptAccess' => 'always',
              'allowNetworking' => 'all',
              'flashvars' => 'chapter_id={2}&channel={1}&hostname=www.twitch.tv&auto_play=false&start_volume=25',
              'movie' => '{protocol}://www.twitch.tv/widgets/archive_embed_player.swf',
            ),
          ),
        ),
        'data' => NULL,
        'dataCallback' => NULL,
      ),
      'twitch' => 
      array (
        'name' => 'Twitch',
        'type' => 'video',
        'website' => 'http://twitch.tv',
        'ssl' => true,
        'url' => 
        array (
          0 => '^(https?://)?(?:www\\.)?twitch\\.tv/([0-9a-zA-Z-_]+)',
        ),
        'info' => 
        array (
          'id' => '{1}',
          'url' => '{protocol}://twitch.tv/{1}',
        ),
        'render' => 
        array (
          'sizeRatio' => 1.64,
          'object' => 
          array (
            'attributes' => 
            array (
              'type' => 'application/x-shockwave-flash',
              'data' => '{protocol}://twitch.tv/widgets/live_embed_player.swf?channel={1}',
              'wmode' => 'transparent',
              'id' => 'live_embed_player_flash',
              'width' => 500,
              'height' => 350,
            ),
            'params' => 
            array (
              'allowFullScreen' => 'true',
              'allowScriptAccess' => 'always',
              'allowNetworking' => 'all',
              'flashvars' => 'hostname=www.twitch.tv&channel={1}&auto_play=false&start_volume=25',
              'movie' => '{protocol}://www.twitch.tv/widgets/live_embed_player.swf',
            ),
          ),
        ),
        'data' => NULL,
        'dataCallback' => NULL,
      ),
      'html5video' => 
      array (
        'name' => 'HTML5 video',
        'type' => 'video',
        'website' => '',
        'ssl' => false,
        'url' => 
        array (
          0 => '^(https?://)?(.*).(mp4|ogg|webm)$',
        ),
        'info' => 
        array (
          'id' => '{1}.{2}',
          'url' => '{1}.{2}',
        ),
        'render' => 
        array (
          'sizeRatio' => 1.77,
          'video' => 
          array (
            'source' => 
            array (
              0 => 
              array (
                'src' => '{protocol}://{1}.webm',
                'type' => 'video/webm',
              ),
              1 => 
              array (
                'src' => '{protocol}://{1}.ogg',
                'type' => 'video/ogg',
              ),
              2 => 
              array (
                'src' => '{protocol}://{1}.mp4',
                'type' => 'video/mp4',
              ),
            ),
            'width' => 560,
            'height' => 315,
            'controls' => 'controls',
            'layout' => 'responsive',
          ),
        ),
        'data' => NULL,
        'dataCallback' => NULL,
      ),
      'gfycat' => 
      array (
        'name' => 'gfycat',
        'type' => 'video',
        'website' => 'http://gfycat.com',
        'ssl' => false,
        'url' => 
        array (
          0 => '^(https?://)?(?:www\\.)?gfycat\\.com/([a-zA-Z]+)',
        ),
        'info' => 
        array (
          'id' => '{1}',
          'url' => '{protocol}://gfycat.com/{1}',
        ),
        'render' => 
        array (
          'sizeRatio' => 1.64,
          'iframe' => 
          array (
            'src' => '{protocol}://gfycat.com/ifr/{1}',
            'scrolling' => 'no',
            'width' => 670,
            'height' => 390,
            'sandbox' => 'allow-scripts allow-same-origin allow-presentation',
            'layout' => 'responsive',
          ),
        ),
        'data' => NULL,
        'dataCallback' => NULL,
      ),
      'web.tv' => 
      array (
        'name' => 'web.tv',
        'type' => 'video',
        'website' => 'http://web.tv',
        'ssl' => false,
        'url' => 
        array (
          0 => '^(https?://)?(\\w+\\.?)?web\\.tv/.*__([a-zA-Z0-9]+)$',
        ),
        'info' => 
        array (
          'id' => '{2}',
          'url' => '{protocol}://{1}web.tv/embed/{2}',
        ),
        'render' => 
        array (
          'sizeRatio' => 1.64,
          'iframe' => 
          array (
            'src' => '{protocol}://{1}web.tv/embed/{2}',
            'scrolling' => 'no',
            'width' => 670,
            'height' => 390,
            'sandbox' => 'allow-scripts allow-same-origin allow-presentation',
            'layout' => 'responsive',
          ),
        ),
        'data' => NULL,
        'dataCallback' => NULL,
      ),
    ),
  ),
  'excel' => 
  array (
    'exports' => 
    array (
      'chunk_size' => 1000,
      'pre_calculate_formulas' => false,
      'csv' => 
      array (
        'delimiter' => ',',
        'enclosure' => '"',
        'line_ending' => '
',
        'use_bom' => false,
        'include_separator_line' => false,
        'excel_compatibility' => false,
      ),
    ),
    'imports' => 
    array (
      'read_only' => true,
      'heading_row' => 
      array (
        'formatter' => 'slug',
      ),
      'csv' => 
      array (
        'delimiter' => ',',
        'enclosure' => '"',
        'escape_character' => '\\',
        'contiguous' => false,
        'input_encoding' => 'UTF-8',
      ),
    ),
    'extension_detector' => 
    array (
      'xlsx' => 'Xlsx',
      'xlsm' => 'Xlsx',
      'xltx' => 'Xlsx',
      'xltm' => 'Xlsx',
      'xls' => 'Xls',
      'xlt' => 'Xls',
      'ods' => 'Ods',
      'ots' => 'Ods',
      'slk' => 'Slk',
      'xml' => 'Xml',
      'gnumeric' => 'Gnumeric',
      'htm' => 'Html',
      'html' => 'Html',
      'csv' => 'Csv',
      'tsv' => 'Csv',
      'pdf' => 'Dompdf',
    ),
    'value_binder' => 
    array (
      'default' => 'Maatwebsite\\Excel\\DefaultValueBinder',
    ),
    'cache' => 
    array (
      'driver' => 'memory',
      'batch' => 
      array (
        'memory_limit' => 60000,
      ),
      'illuminate' => 
      array (
        'store' => NULL,
      ),
    ),
    'transactions' => 
    array (
      'handler' => 'db',
    ),
    'temporary_files' => 
    array (
      'local_path' => '/tmp',
      'remote_disk' => NULL,
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/html/naturecare/storage/app',
      ),
      'google' => 
      array (
        'driver' => 'google',
        'clientId' => '',
        'clientSecret' => '',
        'refreshToken' => '',
        'folderId' => '',
      ),
      'images' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/html/naturecare/storage/files/images',
      ),
      'logo' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/html/naturecare/storage/files/logo',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/html/naturecare/storage/app/public',
        'url' => 'http://naturecare.demo/storage',
        'visibility' => 'public',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => NULL,
        'secret' => NULL,
        'region' => NULL,
        'bucket' => NULL,
        'url' => NULL,
      ),
      'dropbox' => 
      array (
        'driver' => 'dropbox',
        'accessToken' => NULL,
        'appSecret' => NULL,
      ),
    ),
  ),
  'geoip' => 
  array (
    'log_failures' => true,
    'include_currency' => true,
    'service' => 'ipapi',
    'services' => 
    array (
      'maxmind_database' => 
      array (
        'class' => 'Torann\\GeoIP\\Services\\MaxMindDatabase',
        'database_path' => '/var/www/html/naturecare/storage/app/geoip.mmdb',
        'update_url' => 'https://geolite.maxmind.com/download/geoip/database/GeoLite2-City.mmdb.gz',
        'locales' => 
        array (
          0 => 'en',
        ),
      ),
      'maxmind_api' => 
      array (
        'class' => 'Torann\\GeoIP\\Services\\MaxMindWebService',
        'user_id' => NULL,
        'license_key' => NULL,
        'locales' => 
        array (
          0 => 'en',
        ),
      ),
      'ipapi' => 
      array (
        'class' => 'Torann\\GeoIP\\Services\\IPApi',
        'secure' => true,
        'key' => NULL,
        'continent_path' => '/var/www/html/naturecare/storage/app/continents.json',
        'lang' => 'en',
      ),
    ),
    'cache' => 'all',
    'cache_tags' => NULL,
    'cache_expires' => 30,
    'default_location' => 
    array (
      'ip' => '127.0.0.0',
      'iso_code' => 'US',
      'country' => 'United States',
      'city' => 'New Haven',
      'state' => 'CT',
      'state_name' => 'Connecticut',
      'postal_code' => '06510',
      'lat' => 41.31,
      'lon' => -72.92,
      'timezone' => 'America/New_York',
      'continent' => 'NA',
      'default' => true,
      'currency' => 'USD',
    ),
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => 10,
    ),
    'argon' => 
    array (
      'memory' => 1024,
      'threads' => 2,
      'time' => 2,
    ),
  ),
  'htmlmin' => 
  array (
    'blade' => true,
    'force' => false,
    'ignore' => 
    array (
    ),
  ),
  'image' => 
  array (
    'driver' => 'gd',
  ),
  'imagecache' => 
  array (
    'route' => 'img/cache',
    'paths' => 
    array (
      0 => '/var/www/html/naturecare/public/files/images/',
      1 => '/var/www/html/naturecare/public/files/images/icons/',
      2 => '/var/www/html/naturecare/public/files/images/extra/',
      3 => '/var/www/html/naturecare/public/files/images/users/default/',
      4 => '/var/www/html/naturecare/public/files/images/users/profile_photos/',
      5 => '/var/www/html/naturecare/public/files/images/users/profile_photos/thumbs/',
      6 => '/var/www/html/naturecare/public/files/images/users/profile_cover_photos/',
      7 => '/var/www/html/naturecare/public/files/images/users/profile_cover_photos/thumbs/',
      8 => '/var/www/html/naturecare/public/files/images/users/demo/male/',
      9 => '/var/www/html/naturecare/public/files/images/users/demo/female/',
      10 => '/var/www/html/naturecare/storage/files/images/',
      11 => '/var/www/html/naturecare/storage/files/logo/',
    ),
    'templates' => 
    array (
      'small' => 'Intervention\\Image\\Templates\\Small',
      'medium' => 'Intervention\\Image\\Templates\\Medium',
      'large' => 'Intervention\\Image\\Templates\\Large',
      'profile' => 'App\\Filters\\Profile',
      'logo' => 'App\\Filters\\Logo',
      'original' => 'App\\Filters\\Original',
    ),
    'lifetime' => 43200,
  ),
  'languages' => 
  array (
    'en' => 'en',
    'ms' => 'ms',
    'zh' => 'zh',
  ),
  'laravel-translation-manager' => 
  array (
    'primary_locale' => 'en',
    'json_dbkey_length' => 32,
    'locales' => 
    array (
      0 => 'en',
      1 => 'es',
      2 => 'de',
      3 => 'pt',
      4 => 'fr',
      5 => 'it',
      6 => 'tr',
      7 => 'ar',
      8 => 'ms',
      9 => 'zh',
    ),
    'show_locales' => 
    array (
      0 => 'en',
      1 => 'es',
      2 => 'de',
      3 => 'pt',
      4 => 'fr',
      5 => 'it',
      6 => 'tr',
      7 => 'ar',
      8 => 'ms',
      9 => 'zh',
    ),
    'persistent_prefix' => 'g2Lu2pyz8QcVrxhL32eN',
    'admin_enabled' => true,
    'use_cookies' => false,
    'inplace_edit_mode' => 2,
    'user_locales_enabled' => false,
    'markdown_key_suffix' => '',
    'export_format' => 
    array (
      0 => 'PRESERVE_EMPTY_ARRAYS',
      1 => 'USE_HEREDOC',
      2 => 'USE_SHORT_ARRAY',
      3 => 'SORT_KEYS',
    ),
    'mismatch_enabled' => false,
    'exclude_groups' => 
    array (
    ),
    'exclude_page_edit_groups' => 
    array (
    ),
    'log_missing_keys' => false,
    'log_key_usage_info' => false,
    'missing_keys_lottery' => 100,
    'indatabase_publish' => 0,
    'db_connections' => 
    array (
    ),
    'default_connection' => NULL,
    'yandex_translator_key' => 'trnsl.1.1.20170307T095330Z.c036d9051dae0921.8bf401b8ee000d6f3ba6f9e5a146e24850614c5b',
    'language_dirs' => 
    array (
      'lang' => '/resources/lang/{locale}/{group}',
      'packages' => '/resources/lang/vendor/{package}/{locale}/{group}',
      'workbench' => 
      array (
        'include' => '*/*',
        'root' => '/workbench/{vendor}/{package}',
        'files' => 'resources/lang/{locale}/{group}',
      ),
      'vendor' => 
      array (
        'include' => 
        array (
        ),
        'root' => '/vendor/{vendor}/{package}',
        'files' => 'resources/lang/{locale}/{group}',
      ),
      'caouecs/laravel-lang' => 
      array (
        '__merge' => 
        array (
          0 => 'vendor',
          1 => 'workbench',
        ),
        'files' => 'src/{locale}/{group}',
      ),
      'nesbot/carbon' => 
      array (
        '__merge' => 
        array (
          0 => 'vendor',
          1 => 'workbench',
        ),
        'files' => 'src/Carbon/Lang/{locale}',
        'vars' => 
        array (
          '{group}' => 'carbon',
        ),
      ),
    ),
    'zip_root' => '/resources',
  ),
  'logging' => 
  array (
    'default' => 'stack',
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'single',
        ),
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => '/var/www/html/naturecare/storage/logs/laravel.log',
        'level' => 'debug',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => '/var/www/html/naturecare/storage/logs/laravel.log',
        'level' => 'debug',
        'days' => 7,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'critical',
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
      ),
    ),
  ),
  'mail' => 
  array (
    'driver' => 'smtp',
    'host' => 'smtp.mailgun.org',
    'port' => 587,
    'from' => 
    array (
      'address' => 'naturecaremalaysia@gmail.com',
      'name' => 'NATURE CARE',
    ),
    'encryption' => 'tls',
    'username' => NULL,
    'password' => NULL,
    'sendmail' => '/usr/sbin/sendmail -bs',
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => '/var/www/html/naturecare/resources/views/vendor/mail',
      ),
    ),
    'log_channel' => NULL,
  ),
  'passport' => 
  array (
    'private_key' => NULL,
    'public_key' => NULL,
  ),
  'paypal' => 
  array (
    'mode' => 'sandbox',
    'sandbox' => 
    array (
      'username' => '',
      'password' => '',
      'secret' => '',
      'certificate' => '',
      'app_id' => 'APP-80W284485P519543T',
    ),
    'live' => 
    array (
      'username' => '',
      'password' => '',
      'secret' => '',
      'certificate' => '',
      'app_id' => '',
    ),
    'payment_action' => 'Sale',
    'currency' => 'USD',
    'billing_type' => 'MerchantInitiatedBilling',
    'notify_url' => '',
    'locale' => '',
    'validate_ssl' => true,
    'client_id' => 'AZrl0Cxc5rTFGYJ1ouftsgQ_l58RF9FqIe6XQTG6niWhKqG6fC7OSKKf-33aiKa3luucb2z1_131frSw',
    'secret' => 'EADeOaW_aQGZ5h-auUYuTTwcFgX-KAwYzW84kuwfyMb2iVTRRu7d4G8So8qNbajsD7NtA5xR3IWsYyou',
    'settings' => 
    array (
      'mode' => 'sandbox',
      'http.ConnectionTimeOut' => 1000,
      'log.LogEnabled' => true,
      'log.FileName' => '/var/www/html/naturecare/storage/logs/paypal.log',
      'log.LogLevel' => 'FINE',
    ),
  ),
  'purifier' => 
  array (
    'encoding' => 'UTF-8',
    'finalize' => true,
    'cachePath' => '/var/www/html/naturecare/storage/app/purifier',
    'cacheFileMode' => 493,
    'settings' => 
    array (
      'default' => 
      array (
        'HTML.Doctype' => 'HTML 4.01 Transitional',
        'HTML.Allowed' => 'div,b,strong,i,em,u,a[href|title],ul,ol,li,p[style],br,span[style],img[width|height|alt|src]',
        'CSS.AllowedProperties' => 'font,font-size,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align',
        'AutoFormat.AutoParagraph' => true,
        'AutoFormat.RemoveEmpty' => true,
      ),
      'test' => 
      array (
        'Attr.EnableID' => 'true',
      ),
      'youtube' => 
      array (
        'HTML.SafeIframe' => 'true',
        'URI.SafeIframeRegexp' => '%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%',
      ),
      'custom_definition' => 
      array (
        'id' => 'html5-definitions',
        'rev' => 1,
        'debug' => false,
        'elements' => 
        array (
          0 => 
          array (
            0 => 'section',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
          ),
          1 => 
          array (
            0 => 'nav',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
          ),
          2 => 
          array (
            0 => 'article',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
          ),
          3 => 
          array (
            0 => 'aside',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
          ),
          4 => 
          array (
            0 => 'header',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
          ),
          5 => 
          array (
            0 => 'footer',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
          ),
          6 => 
          array (
            0 => 'address',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
          ),
          7 => 
          array (
            0 => 'hgroup',
            1 => 'Block',
            2 => 'Required: h1 | h2 | h3 | h4 | h5 | h6',
            3 => 'Common',
          ),
          8 => 
          array (
            0 => 'figure',
            1 => 'Block',
            2 => 'Optional: (figcaption, Flow) | (Flow, figcaption) | Flow',
            3 => 'Common',
          ),
          9 => 
          array (
            0 => 'figcaption',
            1 => 'Inline',
            2 => 'Flow',
            3 => 'Common',
          ),
          10 => 
          array (
            0 => 'video',
            1 => 'Block',
            2 => 'Optional: (source, Flow) | (Flow, source) | Flow',
            3 => 'Common',
            4 => 
            array (
              'src' => 'URI',
              'type' => 'Text',
              'width' => 'Length',
              'height' => 'Length',
              'poster' => 'URI',
              'preload' => 'Enum#auto,metadata,none',
              'controls' => 'Bool',
            ),
          ),
          11 => 
          array (
            0 => 'source',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
            4 => 
            array (
              'src' => 'URI',
              'type' => 'Text',
            ),
          ),
          12 => 
          array (
            0 => 's',
            1 => 'Inline',
            2 => 'Inline',
            3 => 'Common',
          ),
          13 => 
          array (
            0 => 'var',
            1 => 'Inline',
            2 => 'Inline',
            3 => 'Common',
          ),
          14 => 
          array (
            0 => 'sub',
            1 => 'Inline',
            2 => 'Inline',
            3 => 'Common',
          ),
          15 => 
          array (
            0 => 'sup',
            1 => 'Inline',
            2 => 'Inline',
            3 => 'Common',
          ),
          16 => 
          array (
            0 => 'mark',
            1 => 'Inline',
            2 => 'Inline',
            3 => 'Common',
          ),
          17 => 
          array (
            0 => 'wbr',
            1 => 'Inline',
            2 => 'Empty',
            3 => 'Core',
          ),
          18 => 
          array (
            0 => 'ins',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
            4 => 
            array (
              'cite' => 'URI',
              'datetime' => 'CDATA',
            ),
          ),
          19 => 
          array (
            0 => 'del',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
            4 => 
            array (
              'cite' => 'URI',
              'datetime' => 'CDATA',
            ),
          ),
        ),
        'attributes' => 
        array (
          0 => 
          array (
            0 => 'iframe',
            1 => 'allowfullscreen',
            2 => 'Bool',
          ),
          1 => 
          array (
            0 => 'table',
            1 => 'height',
            2 => 'Text',
          ),
          2 => 
          array (
            0 => 'td',
            1 => 'border',
            2 => 'Text',
          ),
          3 => 
          array (
            0 => 'th',
            1 => 'border',
            2 => 'Text',
          ),
          4 => 
          array (
            0 => 'tr',
            1 => 'width',
            2 => 'Text',
          ),
          5 => 
          array (
            0 => 'tr',
            1 => 'height',
            2 => 'Text',
          ),
          6 => 
          array (
            0 => 'tr',
            1 => 'border',
            2 => 'Text',
          ),
        ),
      ),
      'custom_attributes' => 
      array (
        0 => 
        array (
          0 => 'a',
          1 => 'target',
          2 => 'Enum#_blank,_self,_target,_top',
        ),
      ),
      'custom_elements' => 
      array (
        0 => 
        array (
          0 => 'u',
          1 => 'Inline',
          2 => 'Inline',
          3 => 'Common',
        ),
      ),
    ),
  ),
  'queue' => 
  array (
    'default' => 'database',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'sqs' => 
      array (
        'key' => 'your-public-key',
        'secret' => 'your-secret-key',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
        'region' => 'us-east-1',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
      ),
    ),
    'failed' => 
    array (
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'rave' => 
  array (
    'publicKey' => NULL,
    'secretKey' => NULL,
    'title' => 'Rave Payment Gateway',
    'env' => 'staging',
    'logo' => '',
    'prefix' => 'rave',
    'secretHash' => '',
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
    ),
    'ses' => 
    array (
      'key' => NULL,
      'secret' => NULL,
      'region' => 'us-east-1',
    ),
    'sparkpost' => 
    array (
      'secret' => NULL,
    ),
    'stripe' => 
    array (
      'model' => 'App\\User',
      'key' => NULL,
      'secret' => NULL,
    ),
    'facebook' => 
    array (
      'client_id' => '531419950987882',
      'client_secret' => '13e11316533c1d845048f5a205438991',
      'redirect' => 'http://dev.demo/sociallogin/callback/facebook',
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => 120,
    'expire_on_close' => true,
    'encrypt' => false,
    'files' => '/var/www/html/naturecare/storage/framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'naturecare_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => false,
    'http_only' => true,
    'same_site' => NULL,
  ),
  'shorty' => 
  array (
    'api_key' => NULL,
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'dont_alias' => 
    array (
    ),
  ),
  'trustedproxy' => 
  array (
    'proxies' => NULL,
    'headers' => 30,
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => '/var/www/html/naturecare/resources/views',
    ),
    'compiled' => '/var/www/html/naturecare/storage/framework/views',
  ),
);
