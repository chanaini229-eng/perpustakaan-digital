<?php

ini_set('display_errors', '1');
error_reporting(E_ALL);

$dirs = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
    '/tmp/bootstrap/cache',
];
foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
}

$env = [
    'VIEW_COMPILED_PATH' => '/tmp/storage/framework/views',
    'APP_SERVICES_CACHE' => '/tmp/bootstrap/cache/services.php',
    'APP_PACKAGES_CACHE' => '/tmp/bootstrap/cache/packages.php',
    'APP_CONFIG_CACHE'   => '/tmp/bootstrap/cache/config.php',
    'APP_ROUTES_CACHE'   => '/tmp/bootstrap/cache/routes.php',
    'APP_EVENTS_CACHE'   => '/tmp/bootstrap/cache/events.php',
    'LOG_CHANNEL'        => 'stderr',
];
foreach ($env as $key => $value) {
    putenv("$key=$value");
    $_ENV[$key] = $value;
    $_SERVER[$key] = $value;
}

// DEBUG SEMENTARA: tampilkan error boot yang asli
try {
    require __DIR__ . '/../vendor/autoload.php';
    $app = require __DIR__ . '/../bootstrap/app.php';
    $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
} catch (\Throwable $e) {
    http_response_code(500);
    echo '<pre>' . get_class($e) . ': ' . $e->getMessage()
        . "\n" . $e->getFile() . ':' . $e->getLine() . '</pre>';
    echo '<pre>APP_KEY ada? ' . (getenv('APP_KEY') ? 'ya, panjang ' . strlen(getenv('APP_KEY')) : 'TIDAK') . '</pre>';
    exit;
}

require __DIR__ . '/../public/index.php';