<?php

use Illuminate\Http\Request;

// Menetapkan waktu mulai aplikasi
define('LARAVEL_START', microtime(true));

// Menentukan apakah aplikasi sedang dalam mode pemeliharaan...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Mendaftarkan autoloader Composer...
require __DIR__.'/../vendor/autoload.php';

// Mem-bootstrapping Laravel dan menangani request...
$app = require_once __DIR__.'/../bootstrap/app.php';
$app->run(Request::capture());
