<?php

// Pastikan folder compiled views di /tmp ada untuk Vercel
if (!is_dir('/tmp/views')) {
    mkdir('/tmp/views', 0777, true);
}

require __DIR__ . '/../public/index.php';
