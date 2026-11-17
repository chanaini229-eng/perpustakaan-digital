<?php

// Entry point Laravel untuk Vercel.
// Vercel read-only kecuali /tmp, jadi semua yang ditulis Laravel diarahkan ke sana.

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
    'VIEW_COMPILED_PATH'  => '/tmp/storage/framework/views',
    'APP_SERVICES_CACHE'  => '/tmp/bootstrap/cache/services.php',
    'APP_PACKAGES_CACHE'  => '/tmp/bootstrap/cache/packages.php',
    'APP_CONFIG_CACHE'    => '/tmp/bootstrap/cache/config.php',
    'APP_ROUTES_CACHE'    => '/tmp/bootstrap/cache/routes.php',
    'APP_EVENTS_CACHE'    => '/tmp/bootstrap/cache/events.php',
    'LOG_CHANNEL'         => 'stderr',
];

foreach ($env as $key => $value) {
    putenv("$key=$value");
    $_ENV[$key] = $value;
    $_SERVER[$key] = $value;
}

require __DIR__ . '/../public/index.php';